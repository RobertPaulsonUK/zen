<script>
    const closeHandler = () => {
        document.querySelector('#error-modal').classList.add('hidden')
    }
</script>
<div id="error-modal" class="fixed inset-0 bg-neutral-800/50 z-302 flex justify-center items-center hidden">
    <div class="fixed inset-0 backdrop-blur-xs z-303 flex items-center justify-center">
        <div class="bg-white-900 p-7 rounded border-2 border-red-900 bg-white-600 text-center text-red-600 text-base">
            <div class="message-container">
            <!--   message             -->
            </div>
            <button onclick="closeHandler()" class="mt-4 py-2 px-4 rounded border border-red-900 bg-white-600 text-red-600 text-sm uppercase font-semibold cursor-pointer">
                OK
            </button>
        </div>
    </div>
</div>