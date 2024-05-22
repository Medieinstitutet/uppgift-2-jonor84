<div class="card">
	<div class="card-body">
		<h3>Aktiviteter</h3>
		<ul class="nav nav-pills" id="myTab" role="tablist">
			<li class="nav-item" role="presentation">
				<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Anteckningar</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="newlog-tab" data-bs-toggle="tab" data-bs-target="#newlog" type="button" role="tab" aria-controls="newlog" aria-selected="false">Nya loggen</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="oldlog-tab" data-bs-toggle="tab" data-bs-target="#oldlog" type="button" role="tab" aria-controls="oldlog" aria-selected="false">Gamla loggen</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="messagehistory-tab" data-bs-toggle="tab" data-bs-target="#messagehistory" type="button" role="tab" aria-controls="messagehistory" aria-selected="false">Meddelandehistorik</button>
			</li>
		</ul>
		<? echo $HR10; ?>
		<div class="tab-content mt-3" id="myTabContent">
			<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
				<? include "show_notes.php"; ?>
			</div>
			<div class="tab-pane fade" id="newlog" role="tabpanel" aria-labelledby="newlog-tab">
				<? include "show_lognew.php"; ?>
			</div>
			<div class="tab-pane fade" id="oldlog" role="tabpanel" aria-labelledby="oldlog-tab">
				<? include "show_logold.php"; ?>
			</div>
			<div class="tab-pane fade" id="messagehistory" role="tabpanel" aria-labelledby="messagehistory-tab">
				<? include "show_messagehistory.php"; ?>
			</div>
		</div>
	</div>
</div>