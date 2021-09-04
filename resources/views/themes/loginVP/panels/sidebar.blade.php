<div class="col-md-4 col-sm-12">
    <div class="ask">
        <div style="z-index:3" class="dropdown btn-group btn-group-lg">
            <button id="dropdown-custom-1" role="button" aria-haspopup="true" aria-expanded="false" type="button"
                class="dropdown-toggle btn btn-dark"><a href="https://forms.gle/S4jAchP9FYzoFCe96" style="color:#fff;">I
                    Am Facing Login
                    Issues!</a> <span class="caret"></span></button>
        </div>
    </div>
    <div class="troubleShoot">
        <div class="login-helper" style="font-size:12px;text-align:left;">
            <h2 style="font-size:16px;">Troubleshoot:</h2>
            <ul>
                <li>Make sure the CAPS Lock is off.</li>
                <li>Clear your browser cache and cookies.</li>
                <li>Make sure the internet connection is avaiable and you’re definitely online before trying again.</li>
                <li>Avoid using VPN.</li>
                <li>In case you have forgot your password then <a href="#" style="color:blue;">follow these
                        instructions.</a></li>
                <li>If you still can’t get into your account, <a href="#" style="color:blue;">contact us</a> and we’ll
                    be in touch to help you as soon as we can.</li>
            </ul>
        </div>
    </div>
    <div class="co-author">
        <img src="{{ asset("customtheme/images/elogin-db-stamp.png") }}" class="author_img">
        <div class="content">
            <p style="font-size:12px;">Co-Authored By:</p>
            <h4 style="font-size:14px;font-weight:800;">staffslogin Staff Editor</h4>
        </div>
    </div>
    <div class="details">
        <div class="row">
            <div class="col-md-4">
                <label style="font-size:12px;">Co-authors:</label>
                <p style="font-size:13px;font-weight:800;text-align:center;">4</p>
            </div>
            <div class="col-md-4">
                <label style="font-size:12px;">Updated On:</label>
                <p style="font-size:13px;font-weight:800;">18th February, 2020</p>
            </div>
            <div class="col-md-4">
                <label style="font-size:12px;">Views:</label>
                <p style="font-size:13px;font-weight:800;">189</p>
            </div>
        </div>
    </div>
    <div class="blocks">
        <div class="row">
            <div class="col-md-3">
                <h5 class="text-grey">17</h5>
                <p>Active</p>
            </div>
            <div class="col-md-3">
                <h5 class="text-grey">9</h5>
                <p>Answers</p>
            </div>
            <div class="col-md-3">
                <h5 class="text-grey">9</h5>
                <p>Images</p>
            </div>
            <div class="col-md-3">
                <h5 class="text-grey">16</h5>
                <p>Users</p>
            </div>
        </div>
    </div>
    <div class="sidebar bl-green">
        <div class="header">
            <i class="fa fa-flash"></i>
            Similar Asks
        </div>
        <div class="body">
            <ul>
                @foreach ($sidebar as $item)
                <li><a href="{{ route('post.show',$item->slug) }}"><span
                            class="badge badge-success"><?php echo(rand(10,1000)) ?></span>
                        <div class="sidebar-question">{{ $item->post_title }}</div>
                    </a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <h2>All Post</h2>
    @foreach (array_merge(range('A', 'Z'),range(1,9)) as $char)
    <a href='{{ route('sitemap.show', ['sitemap' => $char]) }}' class='is-capitalized'>{{ $char }}</a>
    @endforeach
</div>
</div>
</div>