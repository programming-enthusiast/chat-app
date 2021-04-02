<template>
    <div class="d-lg-flex mb-4">
        <div class="chat-leftsidebar card">
            <div class="p-3 px-4">
                <div class="media">
                    <div class="media-body">
                        Messenger
                    </div>
                    <div class="dropdown chat-noti-dropdown">
                        <button class="btn dropdown-toggle py-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="uil uil-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="javascript:void(0)" @click="logout">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pb-3">
                <div style="max-height: 470px;">
                    <div class="p-4 border-top">
                        <div>
                        </div>
                    </div>

                    <div class="p-4 border-top">
                        <div>
                            <h5 class="font-size-16 mb-3"><i class="uil uil-user mr-1"></i> Online</h5>

                            <ul class="list-unstyled chat-list">
                                <li v-for="item in onlineUsers">
                                    <a href="javascript:void(0)">
                                        <div class="media align-items-center">
                                            
                                            <div class="avatar-xs mr-3">
                                                <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                    {{ item.slice(0, 1).toUpperCase() }}
                                                </span>
                                            </div>
                                            
                                            <div class="media-body overflow-hidden">
                                                <h5 class="text-truncate font-size-14 mb-1">{{ item }}</h5>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- end chat-leftsidebar -->

        <div class="w-100 user-chat mt-4 mt-sm-0 ml-lg-1">
            <div class="card">
                <div class="p-3 px-lg-4 border-bottom">
                    <div class="row">
                        <div class="col-md-4 col-6">
                        </div>
                    </div>
                </div>

                <div class="px-lg-2">
                    <div class="chat-conversation p-3 custom-m-h">
                        <ul v-chat-scroll class="list-unstyled mb-0 chat-overflow">
                            <li class="chat-day-title"> 
                                <div class="title">Start chat with Messenger</div>
                            </li>
                            <li v-for="item in messages" :class="{ 'right': item.sender }">
                                <div class="conversation-list">
                                    <div class="ctext-wrap">
                                        <div class="ctext-wrap-content">
                                            <h5 class="font-size-14 conversation-name"><a href="javascript:void(0)" class="text-dark">{{ }}</a> <span class="d-inline-block font-size-12 text-muted ml-2">{{ item.time }}</span></h5>
                                            <p class="mb-0">
                                                {{ item.text }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="p-3 chat-input-section">
                    <form @submit.prevent="sendNewMessage">
                    <div class="row">
                        <div class="col-auto">
                            <button type="button" class="btn btn-primary" @click="onUploadAttachmentClick"><span class="d-none d-sm-inline-block mr-2">Upload...</span></button>
                            <input 
                                class="upload-attachment" 
                                id="file-upload" 
                                type="file" 
                                name="file" 
                                accept="image/*" 
                                ref="fileUpload"
                                @change="onFilePicked"
                            />
                        </div>
                        <div v-if="fileName" class="upload-file-name">
                            {{ this.fileName }}
                        </div>
                        <div class="col">
                            <div class="position-relative">
                                <input type="text" class="form-control chat-input rounded" placeholder="Enter Message..." v-model="newMessage.text">
                            </div>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary chat-send w-md waves-effect waves-light"><span class="d-none d-sm-inline-block mr-2">Send</span> <i class="mdi mdi-send float-right"></i></button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import '~/plugins/VueChatScroll'

    export default {
        mounted() {
            
        },
        data() {
            return {
                authData: {
                    username: "",
                },
                messages: [],
                newMessage: {
                    text: ""
                },
                onlineUsers: [],
                image: null,
                fileName: ''
            }
        },
        methods: {
            async logout() {
                await this.$store.dispatch('logout')
                this.redirectToLogin()
            },
            
            outputUsers(users) {
                // this.onlineUsers = []
                // for (let index = 0; index < users.length; index++) {
                //     this.onlineUsers.push(users[index].username)
                // }
            },
            outputMessage(message) {
                // if (message.username === this.authData.username) {
                //     message.sender = true
                // }
                // else {
                //     message.sender = false
                // }
                // this.messages.push(message)
            },
            sendNewMessage() {
                // const message = this.newMessage.text

                // this.newMessage.text = ""

                // this.socket.emit('chatMessage', message)
            },
            redirectToLogin() {
                // this.$router.push("login")
            },
            onUploadAttachmentClick() {
                this.$refs.fileUpload.click()
            },
            onFilePicked(event) {
                const files = event.target.files
                let fileName = files[0].name
                if (!fileName) {
                    return;
                }
                this.fileName = fileName;
                const fileReader = new FileReader()
                fileReader.addEventListener('load', () => {
                    this.imageUrl = fileReader.result
                })
                fileReader.readAsDataURL(files[0])
                this.image = files[0]
            }
        },
    }
</script>

<style scoped>
    body[data-layout=horizontal] .page-content{
        margin-top: 0 !important;
    }
    .simplebar-content-wrapper {
      overflow: auto;
    }
    .chat-overflow {
        height: 300px;
        overflow: auto;
    }
    .chat-overflow::-webkit-scrollbar {
        width: 5px;
        min-height: 20px;
    }
    
    .chat-overflow::-webkit-scrollbar-track {
        border-radius: 10px;
    }
    
    .chat-overflow::-webkit-scrollbar-thumb {
        border-radius: 10px;
        background-color: #5b73e8;
    }
    .upload-attachment {
        display: none;
    }
    .upload-file-name {
        margin: auto;
        width: max-content;
    }
</style>