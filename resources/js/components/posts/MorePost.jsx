import React from 'react'

const MorePost = ({loadPost}) => {
    return (
        <div className="center m-5">
            <a onClick={loadPost}
               className="btn-floating btn-large waves-effect waves-light light nav-color"><i
                className="material-icons">expand_more</i></a>
        </div>
    )
}

export default MorePost;

