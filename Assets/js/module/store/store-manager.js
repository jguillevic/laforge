$(document).ready(function()
{
    $(".add-dayschedulesection-button").click(function(event)
    {
        event.preventDefault();

        var dayId = $(this).attr("data-dayid");

        var sections = $("[id^=dayschedulesection-" + dayId + "]");

        var sectionsContainer = $("#dayschedulesections-container-" + dayId);

        var maxDayScheduleSectionId = 0;
        if (sections.length > 0)
        {
            $(sections).each(function()
            {
                var attrId = $(this).attr("id");
                var dayScheduleSectionId = parseInt(attrId.split("-")[2]);
                
                if (dayScheduleSectionId >= maxDayScheduleSectionId)
                {
                    maxDayScheduleSectionId = dayScheduleSectionId + 1;
                }
            });
        }

        var html = "<section id=\"dayschedulesection-" + dayId + "-" + maxDayScheduleSectionId + "\">";
        html += "<input type=\"text\" id=\"store-schedule-" + dayId + "-startingtime-" + maxDayScheduleSectionId + "\" name=\"store-schedule-" + dayId + "-startingtime-" + maxDayScheduleSectionId + "\">";
        html += "-";
        html += "<input type=\"text\" id=\"store-schedule-" + dayId + "-endingtime-" + maxDayScheduleSectionId + "\" name=\"store-schedule-" + dayId + "-endingtime-" + maxDayScheduleSectionId + "\">";
        html += "<button class=\"delete-dayschedulesection-button\" data-dayid=\"" + dayId + "\" data-dayschedulesectionid=\"" + maxDayScheduleSectionId + "\">x</button>";
        html += "</section>";
        sectionsContainer.append(html);

        $("#dayschedulesection-" + dayId + "-" + maxDayScheduleSectionId).find("button").click(function(event)
        {
            onDeleteDayScheduleSectionButtonClick(event, $(this));
        });
    });

    $(".delete-dayschedulesection-button").click(function(event)
    {
        onDeleteDayScheduleSectionButtonClick(event, $(this));
    });

    function onDeleteDayScheduleSectionButtonClick(event, elt)
    {
        event.preventDefault();

        var dayId = $(elt).attr("data-dayid")
        var dayScheduleSectionId = $(elt).attr("data-dayschedulesectionid");

        $("#dayschedulesection-" + dayId + "-" + dayScheduleSectionId).fadeOut(600, function() { $(this).remove(); });
    }
});