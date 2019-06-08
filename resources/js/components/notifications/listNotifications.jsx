import React from 'react'

const checkType = type => {
    switch (type) {
        case 'like':
            return "notif-like";
        case 'disslike':
            return "notif-disslike";
        default:
            return "";
    }
}


const ListNotifications = ({item, isMobile}) => {
    const mobileClass = isMobile ? "notification-mobile" : null;
    return (
        <div className="d-flex black-text flex-beetween border-bottom align-items">
            <div className={`notifications__item-avatar ${mobileClass} ${checkType(item.data.type)}`}>
                <img src={item.data.user.avatar} alt="Аватарка" title="Аватарка" className="notif-avatar"/>
            </div>
            <span className="line-height2" style={{margin: 5}}>
                <a href={`/user/${item.data.user.id}`} className="site-color-link" style={{fontSize: '11px'}}>{item.data.user.name} &nbsp;</a>
                <a href={`${item.data.href}`} className="black-text" style={{fontSize: '11px'}}>{item.data.message}</a>
            </span>
            <span style={{fontSize: '11px'}} className="black-text line-height2">{getTime(item.created_at)}</span>
        </div>
    )
}

ListNotifications.defaultProps = {
    isMobile: false
};
export default ListNotifications;
