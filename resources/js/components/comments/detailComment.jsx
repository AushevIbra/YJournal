import React from 'react';


const DetailComment = ({comment, className, setUser, setLike, setDisslike}) => {

    return (
        <div className={className} name={comment.id}>
            <div className={`card-panel light lighten-5 z-depth-1 no-shadow`}>
                <div className="inline-flex w-100">
                    <div>
                        <img
                            src={comment.user.avatar} alt=""
                            className="m-5px circle " height="36"/>
                    </div>
                    <div className="w-100">
                        <a href="#" className="site-color-link">
                            {comment.user.name}
                        </a>
                        <div className="flex w-100" style={{justifyContent: "space-between"}}>
                            <span>{comment.text}</span>
                            <div className="comment-rating">
                                <a href="javascript:;" onClick={setLike}><i className="material-icons">keyboard_arrow_up</i></a>
                                <span data-id={comment.id}>{comment.rating}</span>
                                <a href="javascript:;" onClick={setDisslike}><i className="material-icons">keyboard_arrow_down</i></a>
                            </div>
                        </div>
                        <div style={{fontSize: "0.7rem", color: "rgba(167, 167, 167, 0.87)"}}>
                            {getTime(comment.created_at)} <a href="javascript:void(0)"  onClick={setUser.bind(this,comment)} name={`comment-${comment.id}`} style={{fontSize: "0.7rem"}} className="site-color-link">Ответить</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}


export default DetailComment;
