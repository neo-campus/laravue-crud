<template>
    <div class="container mt-3">
         <div class="row justify-content-center">
            <div class="col-md-12">
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
        </div>
    </div>
    
</template>
<script>
export default {
    data() {
        return {
            posts: []
        }
        
    },
    created(){
        let baseURL = window.axios.defaults.baseURL;
        let uri     = baseURL+'/api/posts';
        
        this.axios.get(uri).then(response => {
                this.posts = response.data.data;
        });  
    },
    methods: {
        PostDelete(id){
            let baseURL2 = window.axios.defaults.baseURL;
            let uri2     = baseURL2+`/api/posts/destroy/${id}`;
            this.axios.delete(uri2)
            .then(response => {
                let i = this.posts.map(data => data.id).indexOf(id);
                let t = this.posts.splice(i,1);
                 console.log(t);
            }).catch(error => {
                alert('system error!');
            });
        }
    }
}
</script>