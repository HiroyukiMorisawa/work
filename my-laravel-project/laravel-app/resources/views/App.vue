<template>
    <div class="container">
        <div>
            <div class="content">
                <h1>画像ファイル所属クラス　AI分析</h1>
                <div class="input-group">
                    <label class="input-group-btn">
                        <span class="btn btn-primary">
                            ファイルを選択
                            <input type="file" style="display:none" class="uploadFile" @change="fileSelected">
                        </span>
                    </label>
                    <input type="text" class="form-control" readonly :Value="filename">
                </div>
                <div class="preview_zone" v-if="url">
                    <div class="mb-3">
                        <img :src="url" alt="ここにプレビューが表示されます">
                    </div>
                    <div class="mb-3">
                        <label for="image_path" class="form-label">image_path</label>
                        <input type="text" class="form-control" id="image_path" readonly :Value="image_path">
                    </div>

                    <button type="submit" class="btn btn-primary" @click="fileUpload">アップロード</button>
                </div>
            </div>
        </div>
    </div>

    <div class="album py-5 bg-body-tertiary">
        <div class="container">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <List :key="resetKey"/>
            </div>
        </div>
    </div>
</template>

<script>
import List from './List.vue'

export default {
    data() {
        return {
            fileInfo: '',
            url: '',
            filename: '',
            image_path: '',
            resetKey:0
        }
    },
    components: {
        List
    },
    methods: {
        fileSelected(event) {
            this.fileInfo = event.target.files[0]
            this.url = URL.createObjectURL(this.fileInfo)
            var ts = new Date().getTime()
            this.image_path = '/storage/imgs/' + ts + '/' + this.fileInfo.name
            this.filename = this.fileInfo.name
        },
        fileUpload() {
            const formData = new FormData()

            formData.append('file', this.fileInfo)
            formData.append('image_path', this.image_path)

            axios.post('/api/fileupload', formData).then(response => {
                if (response.status == 200) {
                    alert('アップロードしました')
                } else {
                    alert('アップロードに失敗しました')
                }
                this.resetKey++
            });
        }
    }
}

</script>
