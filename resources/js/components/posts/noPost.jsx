import React from 'react'
import PropTypes from 'prop-types';

const NoPost = ({text, shadow}) => {
    return (
        <div className={`card-panel light lighten-5 z-depth-1 center ${shadow}`}>
            <div style={{
                background: "url('/assets/img/emoji.png') no-repeat center",
                width: '100%',
                minHeight: "10vh",
                backgroundSize: 'contain'
            }}></div>
            <span>{text}</span>
        </div>
    )
}
NoPost.defaultProps = {
    shadow: 'no-shadow'
};
export default NoPost;
