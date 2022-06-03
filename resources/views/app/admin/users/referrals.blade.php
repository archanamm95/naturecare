
<div class="table-responsive">
   <table  class="table  ">
        <thead class="">
            <tr class="">
                <th>
                    {{trans('users.username')}}
                </th>
                <!-- <th>
                    {{trans('users.email')}}
                </th> -->
                <th>
                    {{trans('users.name')}}
                </th>
                <th>
                    {{trans('users.date_joined')}}
                </th>
            </tr>
        </thead>
        @if(count($referrals)>0)
        <tbody>
        
            @foreach ($referrals as $refs)

            <tr class="">
                <td>
                    {{$refs->username}}
                </td>
              <!--   <td>
                    {{$refs->email}}
                </td> -->
                <td>
                    {{$refs->name}} {{$refs->lastname}}
                </td>
                <td>
                    {{$refs->created_at}}
                </td>
               <!--  <td>
                    {{ date('d M Y',strtotime($refs->created_at)) }}
                </td> -->
            </tr>
            @endforeach
        @else
        <tr>
       <td class="text-center" colspan="8"> {{trans('report.no_data_found')}}</td>
     </tr>  
        @endif
        </tbody>
    </table>
</div>