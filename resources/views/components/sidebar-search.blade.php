 <div>
     <h3 class="font-semibold mb-2">Tìm kiếm</h3>
     <div class="">
         <form action="{{ route('search_posts') }}" class="flex" method="GET">
             <input id="search-query" name="q" type="text" placeholder="Nhập để tìm kiếm bài viết"
                 class="border border-border px-3 py-2 w-full rounded-l"
                 value="{{ request('q') ? request('q') : '' }}" />

             <button type="submit"
                 class="text-white bg-accent px-5 py-2 rounded-r-md text-sm font-medium hover:bg-opacity-90 transition-all flex items-center justify-center whitespace-nowrap">
                 Tìm kiếm
             </button>
         </form>

     </div>
 </div>
