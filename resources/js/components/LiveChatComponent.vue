<template>
  <div class="messages px-5 col-md-10" v-chat-scroll>
    <div>
      <div class="message" v-for="(message, index) in messages" :key="index">
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
</template>

<script>
import AdminChatTile from "./AdminChatTile.vue";
import MyChatTileComponent from "./MyChatTileComponent.vue";
export default {
  components: { MyChatTileComponent, AdminChatTile },
  data: () => ({
    messages: [],
    newMessage: "",
    user_id: null,
  }),

  created() {
    this.user_id = currentUser.id;
    this.fetchMessages();

    Echo.private(`admin-${currentUser.id}`).listen("AdminSentMessage", (e) => {
      this.messages.push(e.message);
    });
  },

  methods: {
    fetchMessages() {
      axios.get("/my-messages").then((response) => {
        this.messages = response.data;
      });
    },

    addMessage(message) {
      axios
        .post("/sendmessage", {
          message,
          user_id: "admin",
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
</style>
