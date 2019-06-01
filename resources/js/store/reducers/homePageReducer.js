import { combineReducers } from 'redux'
import liveComments from './liveComments';
import notifications from './notifications';
import user from './user';

const homePageReducer = combineReducers({
    comments: liveComments,
    notifications,
    user
});


export default homePageReducer
