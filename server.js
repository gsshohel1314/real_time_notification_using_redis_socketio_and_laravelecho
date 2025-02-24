import { createServer } from 'http';
import { Redis } from 'ioredis';
import { Server } from 'socket.io';

const server = createServer();

const io = new Server(server, {
    cors: {
        origin: "*",
    }
});

const redis = new Redis();

// Subscribe to Redis Channel
redis.subscribe('posts-channel', (err, count) => {
    if (err) {
        console.error(`[REDIS ERROR] Subscription failed: ${err.message}`);
    } else {
        console.log(`[REDIS] Successfully subscribed to ${count} channel(s).`);
    }
});

// Listening for messages from Redis
redis.on('message', (channel, message) => {
    const event = JSON.parse(message);
    console.log(`[REDIS MESSAGE] Event: ${event.event} | Channel: ${channel}`);

    // Emitting event to all connected clients
    io.emit(event.event, channel, event.data);
    console.log(`[SOCKET.IO] Event emitted: ${event.event} | Data:`, event.data);
});

// Handle new client connections
io.on('connection', (socket) => {
    console.log(`[SOCKET.IO] New client connected: ${socket.id}`);

    socket.on('disconnect', () => {
        console.log(`[SOCKET.IO] Client disconnected: ${socket.id}`);
    });
});

server.listen(6001, () => {
    console.log(`[SERVER] Listening for WebSocket connections on port :6001`);
});