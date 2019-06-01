import React, {useState, useEffect} from 'react';
import ReactDOM from "react-dom";
// import axios from '../../config/axios';
import {connect} from "react-redux";
import {commentActions} from '../../store/actions/comments';

const AddComment = ({user, setUserForReplyComment, id}) => {
    const [comment, setComment] = useState('');
    const [loading, setLoading] = useState(false);
    const handleChange = (e) => {
        setComment(e.target.value);
    }
    const deleteUser = () => {
        setUserForReplyComment(null)
    }
    const renderLink = (name) => `Ответить: <a href="#">${name}</a>`;

    const handleClick = () => {
        setLoading(true);
        const parentID = (user === null) ? 0 : user.parent_id; // если нет род коммента. то подставится значение 0 - родитель
        axios.post('/comments', {
            text: comment,
            posts_id: id,
            parent_id: (user !== null && user.parent_id === 0) ? user.id : parentID,
            userID: (user !== null) ? user.user.id : null,
        }).then(() => {
            setComment('');
            setUserForReplyComment(null)
            setLoading(false)
            M.toast({html: "Комментрий добавлен!", classes: 'rounded'})
        }).catch((errors) => {
            setLoading(false);
            const response = errors.response.data.errors;
            Object.keys(response).map(key => {
                response[key].map(msg => {
                    M.toast({html: msg, classes: 'rounded'})
                })
            })
        })
    };
    return (
        <div>
            <form>
                <div className="d-flex">
                    <div className="w-100">
                        <textarea className="materialize-textarea" onChange={handleChange} value={comment} name="text" id="editor"
                                  placeholder="Ваш комментарий"></textarea>
                        <div id="reply-address">
                            {user !== null ? <div style={{display: 'flex'}}>
                                <div dangerouslySetInnerHTML={{__html: renderLink(user.user.name)}}></div>
                                <a href="javascript:void(0)"> <i className='material-icons'
                                                                 onClick={deleteUser}>clear</i></a></div> : null}
                        </div>
                    </div>

                    {loading === false ? <button type="button" className="btn site-color" onClick={handleClick}>Добавить</button>
                        :
                        <div className="preloader-wrapper small active">
                            <div className="spinner-layer spinner-blue-only">
                                <div className="circle-clipper left">
                                    <div className="circle"></div>
                                </div>
                                <div className="gap-patch">
                                    <div className="circle"></div>
                                </div>
                                <div className="circle-clipper right">
                                    <div className="circle"></div>
                                </div>
                            </div>
                        </div>
                    }

                </div>
            </form>
        </div>
    )
}

const mapStateToProps = (state) => {
    return {
        user: state.comments.comment,
        id: state.comments.id
    }
};


export default connect(mapStateToProps, {...commentActions})(AddComment);
