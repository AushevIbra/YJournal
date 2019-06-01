import { combineReducers } from 'redux'
import comments from './comments';
import notifications from './notifications';

const rootReducer = combineReducers({
    comments,
});

const notificationReducer = combineReducers({
    notifications,
});
export default rootReducer
