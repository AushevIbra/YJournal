const commentActions = {
    setComments:  cred => ({
        type: "SET_COMMENTS",
        payload: cred,
    }),
    setUserForReplyComment: cred => ({
        type: "SET_USER",
        comment: cred,
    }),
    setPostId: id => ({
        type: "SET_ID_POST",
        id
    }),
    setLiveComments: comments => ({
        type: "SET_LIVE_COMMENTS",
        comments: comments
    }),
    appendLiveComments: comment => ({
        type: "APPEND_LIVE_COMMENT",
        comment
    }),
    setCurrentUser: user => ({
        type: "SET_CURRENT_USER",
        user
    })
}

export { commentActions }
