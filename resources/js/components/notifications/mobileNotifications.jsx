import React, {useEffect, useState} from 'react';
import ListNotifications from "./listNotifications";
import NoPost from "../posts/noPost";
import {notificationActions} from '../../store/actions/notifications';
import {connect} from "react-redux";


const MobileNotification = ({notifications,setNotifications}) => {
    const [isReady, setReady] = useState(false);
    const [nextPageUrl, setNextPageUrl] = useState(null);
    const [showNotification, setShowNotification] = useState(true);

    useEffect(() => {
        if (isReady == false) {
            setReady(true);
            getNotifications()
        }
    }, [])


    const getNotifications = () => {
        axios.get("/api/notification")
            .then(response => {

                setNotifications(response.data.notifications);
                // setNextPageUrl(response.data.next_page_url)
            })
            .catch(error => {
                console.log(error)
            })
    }

    const toggleNotif = () => {
        //console.log(!showNotification);
        setShowNotification(!showNotification);
    };
    return (
        <div>
            {showNotification === true
                ?
                <div className={`card-panel light lighten-5 z-depth-1`}>
                    <div className="card-title center">
                        <h3 className="black-text" style={{fontSize: '11px'}}><b>Уведомления</b></h3>
                        <div style={{width: "100%", borderBottom: '1px solid #eaeaea'}}></div>
                    </div>
                    <div>
                        {notifications.map(item => {
                            return (
                                <ListNotifications item={item} key={`${item.id}`} isMobile={true}/>
                            )
                        })}

                        {notifications.length == 0 ? <NoPost text={""}/> : null}
                    </div>

                </div>
                : null
            }
        </div>
    )
}

const mapStateToProps = (state) => {
    return {
        notifications: state.notifications.items
    }
};

export default connect(mapStateToProps, {...notificationActions})(MobileNotification);
