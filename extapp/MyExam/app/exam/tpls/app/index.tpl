{x2;include:header}
<body>
{x2;include:nav}
<div class="row-fluid">
	<div class="container-fluid examcontent">
		<div class="exambox" id="datacontent">
			<div class="examform">
                            <ul class="thumbnails">
				<div class="span12">
                                    <div class="carousel slide" id="carousel-618293">
                                        <ol class="carousel-indicators">
                                            <li class="active" data-slide-to="0" data-target="#carousel-618293">
                                            </li>
                                            <li data-slide-to="1" data-target="#carousel-618293">
                                            </li>
                                            <li data-slide-to="2" data-target="#carousel-618293">
                                            </li>
                                        </ol>
                                        <div class="carousel-inner">
                                            <div class="item active">
						<img alt="" src="{x2;$contents['contentthumb']}" />
						<div class="carousel-caption">
							<h4>
								棒球
							</h4>
							<p>
								棒球运动是一种以棒打球为主要特点，集体性、对抗性很强的球类运动项目，在美国、日本尤为盛行。
							</p>
						</div>
                                            </div>
					<div class="item">
						<img alt="" src="{x2;$contents['contentthumb']}" />
						<div class="carousel-caption">
							<h4>
								冲浪
							</h4>
							<p>
								冲浪是以海浪为动力，利用自身的高超技巧和平衡能力，搏击海浪的一项运动。运动员站立在冲浪板上，或利用腹板、跪板、充气的橡皮垫、划艇、皮艇等驾驭海浪的一项水上运动。
							</p>
						</div>
					</div>
					<div class="item">
						<img alt="" src="{x2;$contents['contentthumb']}" />
						<div class="carousel-caption">
							<h4>
								自行车
							</h4>
							<p>
								以自行车为工具比赛骑行速度的体育运动。1896年第一届奥林匹克运动会上被列为正式比赛项目。环法赛为最著名的世界自行车锦标赛。
							</p>
						</div>
					</div>
                                        </div> <a data-slide="prev" href="#carousel-618293" class="left carousel-control">‹</a> <a data-slide="next" href="#carousel-618293" class="right carousel-control">›</a>
                                    </div>
                                </div>
				</ul>
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#panel-461715" data-toggle="tab">我的考场</a>
					</li>
				</ul>
				<ul class="thumbnails">
					{x2;tree:$basics,basic,bid}
					<li class="span2">
						<div class="thumbnail">
                                                    <img alt="300x200" src="{x2;if:v:basic['basicthumb']}{x2;v:basic['basicthumb']}{x2;else}app/exam/styles/image/paper.png{x2;endif}" style="width:148px;height:148px;"/>
							<div class="caption">
								<p class="text-center">
									<a class="ajax btn btn-primary" href="index.php?{x2;$_app}-app-index-setCurrentBasic&basicid={x2;v:basic['basicid']}" title="{x2;v:basic['basic']}">{x2;substring:v:basic['basic'],15}</a>
								</p>
							</div>
						</div>
					</li>
					{x2;if:v:bid % 6 == 0}
					</ul>
					<ul class="thumbnails">
					{x2;endif}
					{x2;endtree}
				</ul>
			</div>
		</div>
	</div>
</div>
{x2;include:foot}
</body>
</html>