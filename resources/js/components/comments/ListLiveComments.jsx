import React from 'react';

const ListLiveComments = ({comments}) => {
    return (
        <ul style={{border: "none"}} className="collection">
            {comments.map(item => {
                return (
                    <li className="collection-item avatar"
                        key={`${item.id}-${item.user.avatar}`}>
                        <img src={item.user.avatar} alt="" className="circle"/>
                        <span className="title f-size">{item.user.name}</span>
                        <p className="f-size">
                            <a href={`/post/${item.post.slug}#${item.id}`}>{item.text.length > 15 ? `${item.text.substr(0, 15)}...`: item.text }</a>
                            <br/>
                            {getTime(item.created_at)}
                        </p>

                    </li>
                )
            })}
        </ul>
    )
}

export default ListLiveComments;
