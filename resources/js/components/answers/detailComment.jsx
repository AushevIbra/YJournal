import React from 'react';


const DetailComment = ({comment, className, setUser}) => {

    return (
        <div className={className}>
            <div className={`card-panel light lighten-5 z-depth-1 no-shadow`}>
                <div className="inline-flex">
                    <div>
                        <img
                            src={comment.user.avatar} alt=""
                            className="circle m-5px" height="36"/>
                    </div>
                    <div>
                        <a href="#" className="site-color-link">
                            {comment.user.name}
                        </a>
                        <div>
                            {comment.text}
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
