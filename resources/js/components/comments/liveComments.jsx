import React, {useEffect, useState} from 'react';
// import axios from '../../config/axios';
import ListLiveComments from "./ListLiveComments";
import {connect} from "react-redux";
import {commentActions} from '../../store/actions/comments';

const LiveComments = ({comments, setLiveComments, appendLiveComments, setCurrentUser}) => {
    const [isReady, setReady] = useState(false);
    useEffect(() => {
        if (isReady == false) {
            Echo.channel('live-comments')
                .listen('LiveCommentEvent', e => {
                    appendLiveComments(e.comment);
                })
            axios.get('/api/comments/live')
                .then(response => {
                    setReady(true);
                    setLiveComments(response.data.data);

                })
                .catch(error => {
                    console.log(error);
                })
        }
    }, []);


    return (
        <div className="card-panel light lighten-5 z-depth-1 no-shadow widget mb-5">
            <div className="row valign-wrapper">
                <div className="col s12">
                    <div className="center">
                        <span style={{fonWeight: "bold", fontSize: "0.9em"}}
                              className="grey-text">АКТИВНОСТЬ</span>
                    </div>
                    <div>
                        <ListLiveComments comments={comments}/>
                    </div>
                </div>
            </div>
        </div>
    )
}

const mapStateToProps = (state) => {
    return {
        comments: state.comments.items
    }
};

export default connect(mapStateToProps, {...commentActions})(LiveComments);
