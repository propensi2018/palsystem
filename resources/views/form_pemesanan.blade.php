@extends('layouts.master')

@section('title', 'Generate Unique Code')

@section('contents')

<div id="uc" align="center">
    <form>
        <input id="iUC" type="button" class="btn " value="Generate Unique Code" onclick="window.location.href='generateUC'" />
    </form>
</div>

@endsection

