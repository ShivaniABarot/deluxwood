                         @foreach($tracking_data as $val)
							<tr>
								<td><strong>{{$val->customer_draft_id}}</strong></td>
								<td>{{$val->representative_name}}</td>
								   <td>
							            @foreach(explode(',', $val->door_style_names) as $door_style_name)
							                {{ $door_style_name }}<br>
							            @endforeach
							        </td>
								<td>@if($val->draft_status == "Inprogress")
								<strong>{{"In Progress"}}</strong>
									@else	
									<strong>{{$val->draft_status}}</strong>
									@endif</td>
								<td>
									<div class="btn-group" role="group" aria-label="Basic outlined example">
										<a href="{{url('tracking-status\view')}}\{{$val->customer_draft_id}}" class="btn btn-outline-secondary"><i class="icofont-eye text-warning"></i></a>
									</div>
								</td>
							</tr>
							@endforeach