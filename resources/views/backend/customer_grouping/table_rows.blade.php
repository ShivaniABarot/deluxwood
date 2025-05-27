@foreach($customers_data as $val)
    <tr>
        <td><strong>{{$val->customer_id}}</strong></td>
        <td><a target="_blank" href="{{url('admin/customer-view')}}/{{$val->customer_id}}">
            {{$val->company_name}}
            </a>
        </td>
        <td>{{$val->email}}</td>
        <td>{{$val->contact_number}}</td>
        <td><strong>{{$val->group_title}}</strong></td>
        <td>
            <div class="btn-group" role="group" aria-label="Basic outlined example">
                <a href="{{url('admin/customer-grouping/edit')}}/{{$val->customer_id}}" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
            </div>
        </td>
    </tr>
@endforeach