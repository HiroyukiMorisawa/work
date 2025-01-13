<template>
    <div class="col" v-for="(file, index) in files" :key="index">
        <div class="card shadow-sm">
            <img :src="file.image_path" alt="img" clas="img-contain list-img">
            <div class="card-body">
                <ul class="card-text">
                    <li>success: {{ file.success ? true : false }}</li>
                    <li>message: {{ file.message }}</li>
                    <li>class: {{ file.class }}</li>
                    <li>confidence: {{ file.confidence }}</li>
                    <li>request_timestamp: {{ file.request_timestamp }}</li>
                    <li>response_timestamp: {{ file.response_timestamp }}</li>
                </ul>
            </div>
        </div>
    </div>
</template>



<script>
export default {
    data() {
        return {
            files: []
        }
    },
    methods: {
        getFiles() {
            axios.post('/api/getfilelist').then(response => {
                this.files = response.data;
                console.log(response.data);
            });
        }
    },
    mounted() {
        this.getFiles();
    }
}

</script>