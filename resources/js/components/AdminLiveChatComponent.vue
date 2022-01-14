<template>
  <div class="row">
    <div class="col-md-3 border">
      <user-tile
        v-for="(u, i) in users"
        :key="i"
        :user="user(u)"
        @changeUser="changeUserId"
      />
    </div>
    <div class="messages px-5 col-md-9" v-chat-scroll>
      <div>
        <div
          class="message"
          v-for="(message, index) in userMessages"
          :key="index"
        >
          <my-chat-tile-component
            v-if="message.user && message.user.id === user_id"
            :message="message"
          />
          <admin-chat-tile v-else :message="message" />
        </div>
      </div>

      <div class="row justify-content-end">
        <div class="input-group mt-5 col-md-10">
          <input
            type="text"
            name="message"
            class="form-control form-control-lg"
            placeholder="Type your message here..."
            v-model="newMessage"
            @keyup.enter="sendMessage"
          />

          <div class="input-group-append">
            <button class="btn btn-primary" @click="sendMessage">Send</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AdminChatTile from "./AdminChatTile.vue";
import MyChatTileComponent from "./MyChatTileComponent.vue";
import UserTile from "./UserTile.vue";
export default {
  components: { MyChatTileComponent, AdminChatTile, UserTile },
  data: () => ({
    messages: [],
    newMessage: "",
    user_id: null,
    currentUserId: 3,
  }),

  computed: {
    user() {
       return (users) => users.slice().reverse().find(user => user.user_id !== this.user_id)
    },

    users() {
      return this.messages.reduce((prev, current) => {
        let id = parseInt(current.user_id);
        if (id === parseInt(this.user_id)) {
          id = current.receiver_id;
        }
        prev[id] = prev[id] || [];
        prev[id].push(current);


        return prev;
      }, {});
    },

  
    userMessages() {
      if (this.currentUserId) {
        return this.messages.filter(
          (message) => (message.user_id === this.currentUserId || message.receiver_id === this.currentUserId)
        );
      }
      return [];
    },
  },

  created() {
    this.user_id = currentUser.id;
    this.fetchMessages();

    Echo.private("chat").listen("MessageSentEvent", (e) => {
      this.messages.push(e.message);
    });
  },

  methods: {
    changeUserId(id) {
      this.currentUserId = id;
    },

    fetchMessages() {
      axios.get("/my-messages").then((response) => {
        this.messages = response.data;
      });
    },

    addMessage(message) {
      axios
        .post("/sendmessage", {
          message,
          user_id: this.currentUserId,
        })
        .then((response) => {
          this.messages.push(response.data.message);
        });
    },

    sendMessage() {
      this.addMessage(this.newMessage);
      this.newMessage = "";
    },
  },
};
</script>

<style scoped>
.messages {
  max-height: 70vh;
  height: 70vh;
  display: flex;
  flex-direction: column;
  overflow-y: auto;
  justify-content: space-between;
}
.messages::-webkit-scrollbar {
  display: none;
}

.border {
  border-right: 1px solid #ddd;
  height: 100vh;
  padding: 0;
}
</style>
