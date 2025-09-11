 <table class="table">
     <tbody>
         @foreach ($deadlineTasks as $task)
             <tr>
                 <td>
                     <div class="form-check">
                         <label class="form-check-label">

                         </label>
                     </div>
                 </td>
                 <td>
                     <p class="title">{{ $task->title }}</p>
                     <p class="text-muted">{{ $task->deadline }}</p>
                     @foreach ($task->categories as $category)
                         <p class="title">{{ $category->name }}</p>
                     @endforeach
                     @foreach ($task->users as $user)
                         <p class="text-muted">{{ $user->name }}</p>
                     @endforeach
                 </td>
                 <td class="td-actions text-right">

                 </td>
             </tr>
         @endforeach
     </tbody>
 </table>

 <style>

 </style>
