import React from 'react';
import DetailComment from "./detailComment";
import {connect} from "react-redux";
import {commentActions} from "../../store/actions/comments";
import MorePost from "../posts/MorePost";
import PostItem from "../posts/Post";

const ListComment = ({comments, setUserForReplyComment, moreComment, nextPage}) => {
    const setUser = (comment) => {
        setUserForReplyComment(comment)
    }
    const setRating = (parameters) => {
        const {id, type} = parameters;
        axios.post(`/api/${type}/` + id, {model: "App\\Models\\Comment"})
            .then(response => {
                window.$(`[data-id=${id}]`).text(response.data.rating)
            })


    }
    return (
        <div>
            {comments !== null && comments.map((item, key) => {
                return (
                    <div key={item.id} className="row">

                        <DetailComment setLike={setRating.bind(this, {type: 'like', id: item.id})}
                                       setDisslike={setRating.bind(this, {type: 'disslike', id: item.id})}
                                       className="col s12"
                                       comment={item}
                                       setUser={setUser}
                        />
                        {item.children_comments.map((comment, key) => {
                            return (
                                <DetailComment setLike={setRating.bind(this, {type: 'like', id: comment.id})}
                                               setDisslike={setRating.bind(this, {type: 'disslike', id: comment.id})}
                                               className="col s11 offset-s1"
                                               comment={comment}
                                               key={comment.id}
                                               setUser={setUser}
                                />
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
