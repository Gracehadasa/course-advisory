<template>
    <div class="user-tile" @click="$emit('changeUser', user.user_id)">
        <h5 class="user-tile__name">{{user.user.name}}</h5>
        <span class="user-tile__number">{{user.message}}</span>
    </div>
</template>

<script>
export default {
    props:{
        user:{
            type: Object,
            required: true
        }
    }
}
</script>

<style lang="scss" scoped>
.user-tile {
    display: flex;
    flex-direction: column;
    padding: 15px 20px;
    border-bottom: 1px solid #ededed;
    background: #fafafa;
    cursor: pointer;

    &:hover {
         background: #f0f1f8;
    }

    &__name {
        font-weight: bolder;
        color: rgb(83, 83, 83);
    }
}
</style>