   

        <div class="table-responsive">
            <table class="table table-inbox">
                <tbody class="rowlink" data-link="row">
                    @if($limit_mail>0)
                                    @foreach ($all_mail as $mail)

                                    @php
                                    if($mail->read === 'no'){
                                        $readClass = 'unread';
                                    }else{
                                        $readClass = 'read';
                                    }

                                    if(!isset($mail->profile) || $mail->profile === '600'){
                                        $profilepic = 'avatar-big.png';
                                    }else{
                                        $profilepic = $mail->profile;
                                    }

                                    $subject = preg_replace('/(\>)\s*(\<)/m', '$1$2', $mail->message_subject);
                                    $message = preg_replace('/(\>)\s*(\<)/m', '$1$2', $mail->message);

                                    @endphp
                  

                         <tr class="mail-link {{$readClass}}" data-datetime="{{$mail->created_at}}" data-emailid="{{$mail->email}}" data-mailid="{{Crypt::encrypt($mail->id)}}" data-message="{{$message}}" data-profilepic="{{$profilepic}}" data-subject="{{$subject}}" data-totalmailfromuser="{{$mail->id}}" data-username="{{$mail->username}}">


                  
                            <td class="table-inbox-checkbox rowlink-skip">
                        <input class="styled" type="checkbox"/>

                             </td>
                                    <td class="table-inbox-star rowlink-skip">
                                        <a href="#">
                                            <i class="icon-star-full2 text-warning-300"></i>
                                        </a>
                                    </td>
                                    <td class="table-inbox-image">
                                        <img src="{{url('img/cache/profile/')}}/{{$profilepic}}" class="rounded-circle" width="32" height="32" alt="">
                                    </td>
                                    <td class="table-inbox-name">
                                        <a href="mail_read.html">
                                            <div class="letter-icon-title text-default"> {{$mail->username}} </div>
                                        </a>
                                    </td>
                                    <td class="table-inbox-message">

                                        <span class="table-inbox-subject">
                                        {{ str_limit(strip_tags($subject), $limit = 40, $end = '...') }} -
                                        </span>
                                        <span class="text-muted font-weight-normal">
                                            {!! preg_replace('/\s+/', ' ',strip_tags($message)) !!}
                                        </span>
                                    <td class="table-inbox-attachment"></td>
                                    <td class="table-inbox-time">
                                         {{ Date('h:i A',strtotime($mail->created_at))}}
                                    </td>
                                </tr>


                     
                   
                    @endforeach
                @else
                    <tr class="unread">
                        <td class="text-center">
                            {{ trans('mail.you_have_no_messages') }}
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <!-- <input type="text" value="Washington,Alaska" data-role="tagsinput" class="tagsinput-typeahead"> -->
        </div>