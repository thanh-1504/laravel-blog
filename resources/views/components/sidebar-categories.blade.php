 <div>
     <h3 class="font-semibold mb-2">Danh mục</h3>
     <ul class="text-sm text-textSub space-y-2">
         @foreach (sidebar_categories() as $item)
             <li class="flex justify-between">
                 <a href="{{ route('category_posts', $item->slug) }}"
                     class="hover:text-accent transition-colors">{{ $item->name }}

                 </a>
                 <small class="">({{ $item->posts->count() }})</small>
             </li>
         @endforeach

     </ul>
 </div>
