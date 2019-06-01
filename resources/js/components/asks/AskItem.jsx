import React from 'react';

const AskItem = ({item}) => {
    return(
        <div className={`card-panel light lighten-5 z-depth-1`} style={{boxShadow: 'none'}}>
            <div className="inline-flex">
                <div>
                    <img
                        src={item.user.avatar} alt=""
                        className="circle m-5px" height="36"/>
                </div>
                <div>
                    <a href={`/asks/${item.id}`} className="black-text" style={{fontWeight: 'bold'}}>
                        {item.title}
                    </a>
                    <div className="d-flex" style={{fontSize: "0.8rem", color: "rgba(167, 167, 167, 0.87)"}}>
                        <p><strong>Добавлено:</strong> {getTime(item.created_at)}</p>
                        <p style={{marginLeft: "3px"}}><strong>Просмотров:</strong> {item.views}</p>
                        <p style={{marginLeft: "3px"}}><strong>Рейтинг:</strong> {item.rating}</p>
                        <p style={{marginLeft: "3px"}}><strong>Ответов:</strong> {item.count_answers_count}</p>
                    </div>
                </div>
            </div>
        </div>
    )
}
export default AskItem;
