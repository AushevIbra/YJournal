import React, {useEffect, useState} from 'react';
import ReactDOM from "react-dom";
import ListNotifications from "./listNotifications";
import NoPost from "../posts/noPost";

const Notification = () => {
    const [isReady, setReady] = useState(false);
    const [notifications, setNotifications] = useState([]);
    const [nextPageUrl, setNextPageUrl] = useState(null);
    const [showNotification, setShowNotification] = useState(false);
    useEffect(() => {
        document.addEventListener('click', () => {
            window.$(document).mouseup(function (e){ // событие клика по веб-документу
                var div = window.$("#notification"); // тут указываем ID элемента
                if (!div.is(e.target) // если клик был не по нашему блоку
                    && div.has(e.target).length === 0) { // и не по его дочерним элементам
                    setShowNotification(false);
                }
            });
        }, false);


        if (isReady == false) {
            setReady(true);
            getNotifications();
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
        setShowNotification(!showNotification);
    };
    return (
        <div>
            <div className="d-flex">
                <a onClick={toggleNotif}>
                    <i className="material-icons notif">notifications</i>
                    <small className="notification-badge">{notifications.length}</small>
                </a>

            </div>
            {showNotification === true
                ?
                <div className={`notification card-panel light lighten-5 z-depth-1`}>
                    <div className="card-title">
                        <div className="center">
                            <span style={{fontSize: '11px'}} className="black-text">Уведомления</span>
                        </div>
                        <div style={{width: "100%", borderBottom: '1px solid #eaeaea'}}></div>
                    </div>
                    <div>
                        {notifications.map(item => {
                            console.log(item)
                            return (
                                <ListNotifications item={item} key={item.id}/>
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

if (document.getElementById('notification')) {
    ReactDOM.render(<Notification/>, document.getElementById('notification'));
}

export default Notification;
