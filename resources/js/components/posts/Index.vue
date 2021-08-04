<template>
    <div class="container-fluid mt-5">
         <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card card-default">
                    <div class="card-header">POSTS</div>

                    <div class="card-body">
                        <router-link :to="{ name: 'create' }" class="btn btn-md btn-success">TAMBAH POST</router-link>

                        <div class="table-responsive mt-2">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>TITLE</th>
                                        <th>KONTEN</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="post in posts" :key="post.id">
                                        <td>{{ post.title }}</td>
                                        <td>{{ post.content }}</td>
                                        <td class="text-center">
                                            <router-link :to="{name: 'edit', params: { id: post.id }}" class="btn btn-sm btn-primary">EDIT</router-link>
                                            <button @click.prevent="PostDelete(post.id)" class="btn btn-sm btn-danger">HAPUS</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-2">
               <coba :total="countPost"></coba>
            </div>
        </div>
    </div>

</template>
<script>
import Coba from './Coba.vue';
    export default {
        components: { Coba },
        data() {
            return {
                posts: [],
                countPost: 0
            }
        },
        created(){
            let uri     = baseURL+'/api/posts';
            this.axios.get(uri).then(response => {
                    this.posts = response.data.data;
            });
            this.totalPost();
        },
        methods: {
            PostDelete(id){
                let uri     = baseURL+`/api/posts/destroy/${id}`;
                this.axios.delete(uri)
                .then(response => {
                    let i = this.posts.map(data => data.id).indexOf(id);
                    let t = this.posts.splice(i,1);
                    this.totalPost();
                }).catch(error => {
                    alert('system error!');
                });
            },
            totalPost(){
                let uri = baseURL+`/api/posts/total-post`;
                this.axios.get(uri).then(response => {
                    this.countPost = response.data.data;
                });
            }
        }
    }
</script>
