import React, {useEffect} from 'react';
import {BrowserRouter as Router, Route, Switch} from 'react-router-dom';
import Post from "../posts/Post";
import ReactDOM from "react-dom";
import TopComment from "../comments/topComment";
import BottomNav from "../bottomNav/bottomNav";
import LiveComments from "../comments/liveComments";
import MobileNotification from '../notifications/mobileNotifications';

import {Provider} from "react-redux";
import {applyMiddleware, createStore} from 'redux';
import logger from 'redux-logger';
import homePageReducer from '../../store/reducers/homePageReducer';

const store = createStore(homePageReducer);

const HomePage = () => {
    useEffect(() => {
        axios.get('/api/current-user')
            .then(res => {
                store.dispatch({
                    type: "SET_CURRENT_USER",
                    user: res.data.user
                })
            })
            .catch(error => {
                console.log(error)
            })
    }, [])
    return (
        <Provider store={store}>
            <Router>
                <div>
                    <div className="row">
                        <Switch>
                            <Route exact path="/" component={() => {
                                return (
                                    <div>
                                        <div className="col m8 s12">
                                            <Post/>

                                        </div>
                                        {!/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) && location.pathname == "/"
                                            ?
                                            <div className="col m3 hide-on-med-and-down right">
                                                {/*<a href="/post/create" className="myButton">Написать <i*/}
                                                    {/*className="material-icons tiny">edit</i></a>*/}
                                                <TopComment/>
                                                <LiveComments/>
                                            </div>
                                            : null
                                        }
                                    </div>

                                )
                            }}/>
                            <Route exact path="/top-comment" component={() => {
                                return (
                                    <div className="col m12 col s12">
                                        <a href="/post/create" className="myButton">Написать
                                            <i className="material-icons tiny">edit</i></a>
                                        <TopComment/>
                                        <LiveComments/>
                                    </div>
                                )
                            }}/>

                            <Route path="/notifications" component={() => {
                                return(
                                    <div className="col m12 col s12">
                                        <MobileNotification />
                                    </div>
                                )
                            }}/>
                        </Switch>

                    </div>

                </div>
                <BottomNav/>
            </Router>

        </Provider>

    )
}


if (document.getElementById('react-posts')) {
    ReactDOM.render(<HomePage/>, document.getElementById('react-posts'));
}
// if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) && location.pathname == "/") {
//     require("../bottomNav/bottomNav")
// }

