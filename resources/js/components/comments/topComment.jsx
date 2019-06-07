import React, {useEffect, useState} from 'react';
import ReactDOM from "react-dom";
// import axios from '../../config/axios';
import NoPost from "../posts/noPost";

const TopComment = () => {
    const [topComment, setComment] = useState(null);
    const [isReady, setReady] = useState(false);

    useEffect(() => {
        if (isReady === false) {
            axios.post('/api/day-comment')
                .then(response => {
                    if (response.data.error === undefined) {
                        setComment(response.data.data);
                    }
                    setReady(true)

                })
        }
    }, [])
    if (isReady && topComment === null) {
        return (<div></div>)
    }
    return (
        <div>
            {topComment !== null

                ?
                <div className="card-panel light lighten-5 z-depth-1 widget">
                    <div className="row valign-wrapper">
                        <div className="col s12">
                            <div>
                        <span style={{fonWeight: "bold", fontSize: "0.9em"}}
                              className="grey-text">КОММЕНТАРИЙ ДНЯ</span>
                            </div>

                            <div className="card-info">
                                <img src={topComment.user.avatar}
                                     width="30" height="30"/>
                                <div>
                                    <a href="#">{topComment.user.name}</a>
                                    <br/>
                                    <a href={`/post/${topComment.post.slug}#${topComment.id}`} className="black-text">{topComment.length > 25 ? `${topComment.text.substr(0, 25)}...` : topComment.text}</a>
                                    <br/>
                                    <span>{getTime(topComment.created_at)}</span>
                                </div>
                                <div className="circle center widget__count"><span>{topComment.rating}</span></div>
                            </div>


                        </div>
                    </div>
                </div>
                :
                null

            }
        </div>

    )
}

export default TopComment;
