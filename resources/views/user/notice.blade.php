@extends('user.layout')

@section('title','ptedu - Notice')

@section('content')
<div class="section notice-table pt-150">
    <div class="container">
        <div class="w-75 m-auto">
            <div class="table-header mb-3">
                <div class="left-content d-flex align-items-center">
                    <h5 class="heading mb-0 mr-5">Notice</h5>
                    <h5 class="heading text-muted mb-0">FAQ</h5>
                </div>
                <div class="right-content d-flex align-items-center">
                    <input type="text" placeholder="Enter Search Items" class="form-control search_box">
                    <button class="btn btn-theme-black text-white font-size-12">Search</button>
                </div>
            </div>
            <table class="table w-100">
                <thead class="notice-table-header">
                    <tr>
                        <th>Number</th>
                        <th>Title</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody class="font-14px">
                    <tr>
                        <td>10</td>
                        <td>더미더미더미더미더미더미더미더미 더미더미더미</td>
                        <td>2022.10.13</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>더미더미더미더미더미더미더미더미</td>
                        <td>2022.10.13</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>더미더미더미더미더미더미더미더미</td>
                        <td>2022.10.13</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>더미더미더미더미더미더미더미더미</td>
                        <td>2022.10.13</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>더미더미더미더미더미더미더미더미</td>
                        <td>2022.10.13</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>더미더미더미더미더미더미더미더미</td>
                        <td>2022.10.13</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>더미더미더미더미더미더미더미더미</td>
                        <td>2022.10.13</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>더미더미더미더미더미더미더미더미</td>
                        <td>2022.10.13</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>더미더미더미더미더미더미더미더미</td>
                        <td>2022.10.13</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>이용약관 및 환불 정책 안내드립니다</td>
                        <td>2022.10.13</td>
                    </tr>
                </tbody>
            </table>
            <div class="custom-pagination py-4">
                <ul>
                    <li><a href="javascript:void(0)"><i class="fas fa-angle-left"></i></a></li>
                    <li><a href="javascript:void(0)" class="active">1</a></li>
                    <li><a href="javascript:void(0)">2</a></li>
                    <li><a href="javascript:void(0)">3</a></li>
                    <li><a href="javascript:void(0)"><i class="fas fa-angle-right"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
