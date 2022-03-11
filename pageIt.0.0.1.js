var doc = null;
var currPageNo = 0;
var totalPages = 1;
var currPage = $('page')[currPageNo];
var init_content = $(currPage).children().toArray();


// blank page calc available space to add
// remaining-space = page-inner-height;
var remaining_space = $(currPage).height();

function pageIt(document) {
    doc = document;

    // for each( child)
    init_content.forEach(child => {
        //get child outer height
        var child_height = Math.ceil($(child).outerHeight(true));

        //if (child-outer-height>remaining-space)
        if (child_height > remaining_space) {
            //  check (child-type)
            if ($(child).is("table"))
            //if child is table
            {
                tableBreaker($(child));
            } else
            /* if ($(child).is("p")) */
            {
                $(child).detach();
                doc.append('<page class="a4"></page>');
                currPageNo = currPageNo + 1;
                totalPages = totalPages + 1
                currPage = $('page')[currPageNo];
                currPage.append(child);
            }
        }
        //else if child height less than remaining space
        // do nothing leave as its
        // only have to break if larger than remaining space

        //calc remaining space
        // after breaking or leaving as it is
        remaining_space = remaining_space - child_height;
    });

    currPageNo = 0;

    $("#nav-currPage").text(currPageNo + 1);
    $("#nav-totalPage").text(totalPages);

    //hide all pages
    $('page').addClass('hidden');
    //but show only first
    $($('page')[0]).removeClass('hidden').addClass('currentPage');

}

function tableBreaker(table) {

    //  for each (tr-of-table)
    var tbl_header = $(table).find("thead");
    var rows = $(table).find("tbody tr");
    slicePoint = 0;
    sliceable_row_height = 0;
    // calculate table padding and margin
    tbl_extra_space = Math.ceil($(table).outerHeight(true)) - Math.ceil($(table).innerHeight());
    remaining_space = remaining_space - Math.ceil($(tbl_header).outerHeight(true)) - tbl_extra_space;

    // find out at which row to slice
    for (i = 0; i < rows.length; i++) {
        tr = rows[i];
        // sum height till less than remianing-space  
        sliceable_row_height = sliceable_row_height + $(tr).outerHeight(true);
        if (sliceable_row_height >= remaining_space) {
            // slicePoint = slicePoint - 1;
            break;
        } else {
            slicePoint = slicePoint + 1;
        }
    }

    //if there is heading and at least one row to slice
    // after the loop slice point would've jumped a point ahead.
    // so reduce one point before proceeding
    //slicePoint = slicePoint - 1
    if (slicePoint > 0) {
        // slice till remaining space;
        var rows_to_cut = $(table).find("tbody tr").slice(slicePoint);
        var $secondTable = $("<table class='pageData' id='" + (currPageNo + 1) + "'><tbody></tbody></table>");
        //add cloned header row to the second table
        $secondTable.prepend(tbl_header.clone());
        $secondTable.find("tbody").append(rows_to_cut);

        $(table).find("tbody tr").slice(slicePoint).remove();
        // add sliced up part to page;
        // create new page;
        doc.append('<page class="a4"></page>');
        // increase page count;
        currPageNo = currPageNo + 1;
        totalPages = totalPages + 1
            // set new page to current;
        currPage = $('page')[currPageNo];
        //refresh the remaining space in new pae
        remaining_space = $(currPage).height();
        // add sliced 2nd part to new page;
        currPage.append($secondTable[0]);
        if ($secondTable.height() > remaining_space)
            tableBreaker($secondTable[0]);
    }
    // if there is no room for even one row after heading
    else {

    }
}

$(document).ready(function() {
    pageIt($('document'));

});



function navToPage(page) {

    var jumpPageNo = 0;
    // change current page number
    switch (page) {
        case 0:
            jumpPageNo = 0;
            break;
        case 1:
            if (currPageNo > 0)
                jumpPageNo = currPageNo - 1;
            break;
        case 2:
            if (currPageNo < (totalPages - 1))
                jumpPageNo = currPageNo + 1;
            else
                jumpPageNo = totalPages - 1;
            break;
        case 3:
            jumpPageNo = totalPages - 1;
            break;
        default:
            jumpPageNo = 0;
            break;
    }

    $('page.currentPage').removeClass('currentPage').addClass('hidden');
    // add visible currentPage Class to current page
    $($('page')[jumpPageNo]).removeClass('hidden').addClass('currentPage');

    //display current pagen no
    $("#nav-currPage").text(jumpPageNo + 1);
    currPageNo = jumpPageNo;
}

function printPaged() {
    var originalContents = document.body.innerHTML;
    var printContents = $('<div></div>');
    $('page').each(function(index, value) {
        $(this).removeClass('hidden');
        printContents.append(value);
    });


    document.body.innerHTML = $(printContents).html();
    window.print();
    document.body.innerHTML = originalContents;
}