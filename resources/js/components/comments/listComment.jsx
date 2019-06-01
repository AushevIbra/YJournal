import React from 'react';
import DetailComment from "./detailComment";
import {connect} from "react-redux";
import {commentActions} from "../../store/actions/comments";
import MorePost from "../posts/MorePost";

const ListComment = ({comments, setUserForReplyComment, moreComment, nextPage}) => {
    const setUser = (comment) => {
        setUserForReplyComment(comment)
    }
    return (
        <div>
            {comments !== null && comments.map(item => {
                return (
                    <div key={item.id}>

                            <DetailComment className="col s12" comment={item} setUser={setUser}/>
                        {item.children_comments.map(comment => {
                           return(
                               <DetailComment className="col s11 offset-s1" comment={comment} key={comment.id} setUser={setUser}/>
                           )
                        })}

                    </div>
                )
            })}

            {nextPage !== null ? <MorePost loadPost={moreComment}/> : null}
        </div>
    )
}
const mapStateToProps = (state) => {
    return {
        comments: state.comments.items,
    }
};

export default connect(mapStateToProps, {...commentActions})(ListComment);
