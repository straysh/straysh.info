<div class="post-nav">
    <div class="panel">
        <div class="panel-heading">文章目录</div>
        <div class="panel-body">
            <div class="nav-body" style="top: 0;">
                <div class="highlight-title" style="display: none;"></div>
                <ul class="articleIndex">
                    <% _.each(h1s, function(item){ %>
                    <li class=""><a href="#<%= item.id %>"><%= item.html %></a></li>
                    <% }) %>
                    {{--<li style="list-style:none;">
                        <ul>
                            <li class=""><a href="#articleHeader3">1. 普通流，块级布局 (css2.1)</a></li>
                            <li class=""><a href="#articleHeader4">2. 普通流，行内布局 (css2.1)</a></li>
                            <li class="active"><a href="#articleHeader5">3. 普通流，块级table布局 (css2.1)</a></li>
                            <li class=""><a href="#articleHeader6">4. 绝对定位布局 (css2.1)</a></li>
                            <li class=""><a href="#articleHeader7">5. css3一系列布局</a></li>
                        </ul>
                    </li>--}}
                </ul>
            </div>
        </div>
    </div>
</div>