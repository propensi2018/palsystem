
@extends('layouts.master')
@section('title','Inbox')
@section('contents')

              <div class="row">
                <div class="col-md-1 col-offset-12"></div>
                <div class="col-md-10 col-offset-12">
                  <div class="message-container">
                    <div class="container message-tab">
                    <div class="row message-content">
                      <div class="col-md-2 col-offset-12 message-user">
                        <div class="message-user-img">
                          <img  src="{{ url('image/user.svg') }}" alt="icon name">
                        </div>
                        <span>To:</span><br>
                        <span> {{$userReceiver[0]->name}}</span>
                      </div>
                      <div class="col-md-10 col-offset-12 message-text">
                        <span><b>{{$textMessage[0]->subject}}</b></span>
                        <p class="message-time">{{$textMessage[0]->time}}</p>
                        {!! $textMessage[0]->message !!}
                      </div>
                    </div>
                  </div>
                </div>
                </div>
              </div>



@endsection
