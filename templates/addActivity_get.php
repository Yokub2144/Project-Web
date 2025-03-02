<section>
    <div class="container">
        <div class="left">
            <img src="image.png" alt="Event Image">
            <button class="button cancel">Cancel</button>
        </div>
        <div class="right">
            <h2>Create Event</h2>
            <form action="/addActivity" method="post">
                <div class="form-group">
                    <input type="text" name="Title" placeholder="Name">
                </div>
                <div class="form-group">
                    <textarea placeholder="Details" name="Description"></textarea>
                </div>
                <div class="form-group">
                    <input type="text" name="Location" placeholder="Location">
                </div>
                <div class="form-group">
                    <input type="number" name="Max" placeholder="Maximum">
                </div>
                <div class="form-group">
                    <input type="date" name="StartDate" placeholder="Start Date">
                    <input type="date" name="EndDate" placeholder="End Date">
                </div>
                <input type="hidden" name="UserID" value="<?= $UserID ?> ?>">
                <input type="submit" value="เพิ่มกิจกรรม">
            </form>
        </div>
    </div>
</section>