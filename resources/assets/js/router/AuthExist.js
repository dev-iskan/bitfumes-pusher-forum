import User from '../helpers/User'

export default function (to, from, next) {
    if(!User.loggedIn()) {
        next()
    }
    else {
        next(false)
    }
}