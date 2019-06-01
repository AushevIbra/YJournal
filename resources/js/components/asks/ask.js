import React, {Component} from 'react';
import AskItem from "./AskItem";
import MorePost from "../posts/MorePost";
import NoPost from "../posts/noPost";


class Ask extends Component {
    constructor(props) {
        super(props);
        this.state = {
            data: null,
            isReady: false,
            type: 'new',
            asks: null,
        }
    }

    componentDidMount() {
        this.getAsk();
    }

    sortPost(type) {
        this.setState({
            type
        }, () => {
            this.getAsk();
        })

    }

    getAsk() {
        this.setState({
            data: null,
            isReady: false,
        })

        axios.get(`/api/asks/${this.state.type}`)
            .then(res => {
                this.setState({
                    data: res.data,
                    isReady: true,
                    asks: res.data.data
                })
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
                        asks: [...this.state.asks, ...res.data.data]
                    })
                })
        } else {
            M.toast({html: "Записей больше нет!", classes: 'rounded'})
        }

    }

    render() {
        const {data, type, asks} = this.state;

        return (
            <div>
                <ul className="d-flex">
                    <li className={type == 'new' ? 'active_city' : null}>
                        <a href="#" onClick={this.sortPost.bind(this, 'new')} className="link_city">
                            НОВЫЕ
                        </a>
                    </li>
                    <li className={type == 'popular' ? 'active_city' : null}>
                        <a href="#" onClick={this.sortPost.bind(this, 'popular')} className="link_city">
                            ПОПУЛЯРНЫЕ
                        </a>
                    </li>
                    <li className={type == 'all' ? 'active_city' : null}>
                        <a href="#" onClick={this.sortPost.bind(this, 'all')} className="link_city">
                            ВСЕ
                        </a>
                    </li>
                </ul>
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

                    : asks.map((item, key) => {
                        return (
                            <AskItem setLike={this.setRating.bind(this, {type: 'like', id: item.id, key})} setDisslike={this.setRating.bind(this, {type: 'disslike', id: item.id, key})}
                                     key={`${item.slug} - ${item.id}`} item={item} addClass={asks.length - 1 === key ? "mb-5" : null}/>
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
        )
    }
}

export default Ask;
