<template>
  <div class="my-chat">
    <p class="my-chat__message">
      {{ message.message }}
    </p>
    <span class="my-chat__date">{{ message.created_at | dateToFromNowDaily }}</span>
  </div>
</template>

<script>
export default {
  props: {
    message: {
      type: Object,
      required: true,
    },
  },
};
</script>

<style lang="scss" scoped>
.my-chat {
  background-color: #dbf4c7;
  margin-top: 20px;
  max-width: 80%;
  width: auto;
  min-width: 10px;
  margin-left: auto;
  border-radius: 10px;
  border-top-right-radius: 0;
  padding: 5px 15px;
  display: flex;
  flex-direction: column;
  box-shadow: 0 1px 2px rgba(10, 10, 10, 0.5);
  &__message {
    font-size: 18px;
    color: #494d46;
    margin-bottom: 0;
  }
  &__date {
    font-size: 12px;
    color: #494d46;
    align-self: flex-end;
  }
}
</style>