import React from 'react';
import {NavLink} from "react-router-dom";
import {connect} from "react-redux";

const BottomNav = ({notifications, user}) => {
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
        return (
            <div className="bottom-navbar nav-color">
                <NavLink to="/" activeClassName={""}><i className="material-icons">home</i></NavLink>
                <NavLink to="/top-comment"><i className="material-icons">insert_comment</i></NavLink>
                {user !== null ?
                    <NavLink to="/notifications"><i className="material-icons">notifications</i>
                </NavLink> : null}
                <a href="/post/create"><i className="material-icons">add</i></a>
            </div>
        )
    }
    return (
        <></>
    )

}

const mapStateToProps = (state) => {
    return {
        comments: state.comments.items,
        user: state.user.user,
        notifications: state.notifications.items
    }
};

// if (document.getElementById('react-bottom-nav')) {
//     ReactDOM.render(<BottomNav/>, document.getElementById('react-bottom-nav'));
// }
// <small className="notification-badge">{notifications.length}</small>
//<NavLink to="/notifications"><i className="material-icons notif">notifications</i>
//                 </NavLink>
export default connect(mapStateToProps)(BottomNav)
