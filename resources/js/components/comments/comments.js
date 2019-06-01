import React, {useEffect, useState} from 'react';
import ReactDOM from "react-dom";
import ListComment from "./listComment";
import {Provider} from "react-redux";
import {applyMiddleware, createStore} from 'redux';
import logger from 'redux-logger';
import rootReducer from '../../store/reducers/rootReducer'
import AddComment from "./addComment";

const store = createStore(rootReducer, applyMiddleware(logger));

const Comments = (props) => {

    const [nextPage, setNextPage] = useState('');
    const [isReady, setReady] = useState(null);
    const id = window.$("#react-comments").attr('data-post-id');
    const link = location.href.split('#');
    useEffect(() => {
        if (isReady == null) {
            Echo.channel('comments-channel.' + id)
                .listen('CommentEvent', e => {
                    const _store = store.getState();
                    if (_store.comments.currentUser !== null && e.comment.user_id !== _store.comments.currentUser.id) {
                        ion.sound.play("button_tiny");
                        M.toast({html: "Появился новый комментарий!", classes: 'rounded'})
                    }
                    store.dispatch({type: "PUSH_COMMENT", comment: [e.comment]})

                })
            getComments();

        }
    }, [])

    const getComments = () => {
        axios.post(nextPage == '' || nextPage == null ? `/api/comments/${id}` : nextPage)
            .then(response => {

                store.dispatch({type: "SET_CURRENT_USER", user: response.data.user})
                store.dispatch({type: "SET_COMMENTS", payload: response.data.data})
                store.dispatch({type: "SET_ID_POST", id: window.$("#react-comments").attr('data-post-id')})
                setNextPage(response.data.next_page_url)
                setReady(true)
                let elem = window.$('[name="' + `${link[link.length - 1]}` + '"]');
                if (elem.length > 0) {
                    window.$(document).scrollTop(elem.offset().top);
                }
            })
    }

    return (
        <Provider store={store}>
            {store.getState().comments.currentUser !== null ? <AddComment/> : null}
            <ListComment moreComment={getComments} nextPage={nextPage}/>
        </Provider>
    )

}

export default Comments;

if (document.getElementById('react-comments')) {
    ReactDOM.render(<Comments/>, document.getElementById('react-comments'));
}
