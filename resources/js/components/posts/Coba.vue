<template>
     <div class="card card-default">
        <div class="card-header text-center">TOTAL POST</div>

        <div class="card-body">
            <h1 class="text-center">{{total}}</h1>
        </div>
     </div>
</template>
<script>
export default {
   props:['total']
}
</script>
