import React, {Component} from 'react';
import ReactDOM from "react-dom";

// import axios from 'axios';
import PostItem from './post_item'
import NoPost from "./noPost";
import MorePost from "./MorePost";

class Post extends Component {
    constructor(props) {
        super(props);
        this.state = {
            data: null,
            isReady: false,
            type: 'new',
            posts: null,
            topComment: null,
            showNav: true,
            userId: null,
            tag: null,
        }
    }

    componentWillMount() {
        const elem = document.getElementById("react-user-post");
        if (elem && elem.getAttribute('data-nav')) {
            this.setState({
                showNav: false,
                userId: elem.getAttribute('data-user') || null,
                tag: elem.getAttribute('data-tag') || null
            })
        }
    }

    componentDidMount() {
        if(this.state.tag === null)
            this.getPost();
        else
            this.getFromTag();
    }

    getPost() {
        this.setState({
            data: null,
            isReady: false,
        })
        let config = {
            params: {
                user: this.state.userId
            },
        }

        axios.get(`/api/post/${this.state.type}`, config)
            .then(res => {
                this.setState({
                    data: res.data,
                    isReady: true,
                    posts: res.data.data
                })
            })
    }

    getFromTag() {
        this.setState({
            data: null,
            isReady: false,
        })
        let config = {
            params: {
                tag: this.state.tag
            },
        }

        axios.get(`/api/post/${this.state.type}`, config)
            .then(res => {
                this.setState({
                    data: res.data,
                    isReady: true,
                    posts: res.data.data
                })
            })
    }

    loadMorePost() {

        let config = {
            params: {
                tag: this.state.tag,
                user: this.state.userId
            },
        }

        if (this.state.data.next_page_url !== null) {
            axios.get(this.state.data.next_page_url, config)
                .then(res => {
                    this.setState({
                        data: res.data,
                        isReady: true,
                        posts: [...this.state.posts, ...res.data.data]
                    })
                })
        } else {
            M.toast({html: "Записей больше нет!", classes: 'rounded'})
        }

    }

    sortPost(type) {
        this.setState({
            type
        }, () => {
            this.getPost();
        })

    }

    setRating(parameters) {
        const {id, type, key} = parameters;
        const newState = [...this.state.posts];
        axios.get(`/api/${type}/` + id)
            .then(response => {
                newState[key].rating = response.data.rating;
                this.setState({
                    posts: newState
                })
            })


    }

    render() {
        const {data, type, posts, showNav} = this.state;
        return (
            <div>
                {showNav && <ul className="d-flex">
                    <li className={type == 'new' ? 'active_city' : null}>
                        <a href="#" onClick={this.sortPost.bind(this, 'new')} className="link_city">
                            НОВОЕ
                        </a>
                    </li>
                    <li className={type == 'popular' ? 'active_city' : null}>
                        <a href="#" onClick={this.sortPost.bind(this, 'popular')} className="link_city">
                            ПОПУЛЯРНОЕ
                        </a>
                    </li>
                    <li className={type == 'all' ? 'active_city' : null}>
                        <a href="#" onClick={this.sortPost.bind(this, 'all')} className="link_city">
                            ВСЕ
                        </a>
                    </li>
                </ul>}
                {data === null
                    ?
                    <div className="card-panel light lighten-5 z-depth-1 no-shadow center">
                        <div className="preloader-wrapper big active">
                            <div className="spinner-layer spinner-blue-only">
                                <div className="circle-clipper left">
                                    <div className="circle"></div>
                                </div>
                                <div className="gap-patch">
                                    <div className="circle"></div>
                                </div>
                                <div className="circle-clipper right">
                                    <div className="circle"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    : posts.map((item, key) => {
                        return (
                            <PostItem setLike={this.setRating.bind(this, {type: 'like', id: item.id, key})} setDisslike={this.setRating.bind(this, {type: 'disslike', id: item.id, key})}
                                      key={`${item.slug} - ${item.id}`} item={item} addClass={posts.length - 1 === key ? "mb-5" : null}/>
                        )
                    })
                }

                {this.state.data !== null && this.state.data.next_page_url !== null ?
                    <MorePost loadPost={this.loadMorePost.bind(this)}/> : null}

                {this.state.isReady == true && data.data.length == 0
                    ?
                    <NoPost text={"Записей не найдено"}/>

                    : null
                }
            </div>
        );
    }
}


export default Post;

if (document.getElementById('react-user-post')) {
    ReactDOM.render(<Post/>, document.getElementById('react-user-post'));
}
