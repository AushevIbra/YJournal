const Redis = require('ioredis'),
    redis = new Redis();

redis.psubscribe('*', function (error, count) {
    //console.log(error)
});

redis.on('pmessages', function (pattern, channel, message) {
    console.log(channel, message)
})
