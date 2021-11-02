const locSearch = window.location.search;
const urlParams = new URLSearchParams(locSearch);
        
const p_Val = [
['offset', "0"],
['ariel', "", "Include", "Exclude", "ShowOnly"],
['eric', "", "Include", "Exclude", "ShowOnly"],
['ursula', "", "Include", "Exclude", "ShowOnly"],
['triton', "", "Include", "Exclude", "ShowOnly"],
['sebastian', "", "Include", "Exclude", "ShowOnly"],
['flounder', "", "Include", "Exclude", "ShowOnly"],
['scuttle', "", "Include", "Exclude", "ShowOnly"],
['max', "", "Include", "Exclude", "ShowOnly"],
['flotsam', "", "Include", "Exclude", "ShowOnly"],
['grimsby', "", "Include", "Exclude", "ShowOnly"],
['louis', "", "Include", "Exclude", "ShowOnly"],
['carlotta', "", "Include", "Exclude", "ShowOnly"],
['sisters', "", "Include", "Exclude", "ShowOnly"],
['misc', "", "Include", "Exclude", "ShowOnly"],
['seal', "", "ShowAll", "No", "Yes"],
['cert', "", "ShowAll", "No", "Yes"],
['framed', "", "ShowAll", "No", "Yes"],
['key', "", "ShowAll", "No", "Yes"],
['master', "", "ShowAll", "No", "Yes"],
['damaged', "", "ShowAll", "No", "Yes"]
];

const phpUrl = {
    fwd: "PHP/button_fwd.php",
    bck: "PHP/button_bck.php",
    scene: "PHP/scene_select.php",
    but: "PHP/button_init.php",
    load: "PHP/load_cels.php",
}
Object.freeze(phpUrl);

const p_Enums = {
    Offset: 0,
    Ariel: 1,
    Eric: 2,
    Ursula: 3,
    Triton: 4,
    Sebastian: 5,
    Flounder: 6,
    Scuttle: 7,
    Max: 8,
    Flotsam: 9,
    Grimsby: 10,
    Louis: 11,
    Carlotta: 12,
    Sisters: 13,
    Misc: 14,
    Seal: 15,
    Cert: 16,
    Framed: 17,
    Key: 18,
    Master: 19,
    Damaged: 20
}
Object.freeze(p_Enums);

p_Val.forEach(para => {
    if(urlParams.has(para[0]))
    {
        para[1] = urlParams.get(para[0]);
    }
});

const ajaxData = {
    offset: p_Val[p_Enums.Offset][1],
    ariel: p_Val[p_Enums.Ariel][1],
    eric: p_Val[p_Enums.Eric][1],
    ursula: p_Val[p_Enums.Ursula][1],
    triton: p_Val[p_Enums.Triton][1],
    sebastian: p_Val[p_Enums.Sebastian][1],
    flounder: p_Val[p_Enums.Flounder][1],
    scuttle: p_Val[p_Enums.Scuttle][1],
    max: p_Val[p_Enums.Max][1],
    flotsam: p_Val[p_Enums.Flotsam][1],
    grimsby: p_Val[p_Enums.Grimsby][1],
    louis: p_Val[p_Enums.Louis][1],
    carlotta: p_Val[p_Enums.Carlotta][1],
    sisters: p_Val[p_Enums.Sisters][1],
    misc: p_Val[p_Enums.Misc][1],
    seal: p_Val[p_Enums.Seal][1],
    cert: p_Val[p_Enums.Cert][1],
    framed: p_Val[p_Enums.Framed][1],
    key: p_Val[p_Enums.Key][1],
    master: p_Val[p_Enums.Master][1],
    damaged: p_Val[p_Enums.Damaged][1]
}

function getAjaxPost(target)
{
    const ajaxPost = {
        method: "POST",
        url: target,
        data: ajaxData,
    }
    return ajaxPost;
}

function parChange(parName, condition)
{
    const myURL = window.location.search;
    const urlParams = new URLSearchParams(myURL);

    var startLine = String(myURL);
    var finishLine = new String();

    if(urlParams.has('offset'))
    {
        var oldCond = "offset=" + p_Val[p_Enums.Offset][1];
        startLine = startLine.replace(oldCond, "offset=0");
    }

    if(urlParams.has(parName))
    {
        if(condition != urlParams.get(parName))
        {
            var indexOfCondition = startLine.indexOf(parName) + parName.length + 1;

            var prefix = (startLine.charAt((startLine.indexOf(parName)) - 1) == '&' ? '&' : '?');

            var oldCond = prefix + parName + "=" + urlParams.get(parName);

            if(condition == "null")
            {
                finishLine = startLine.replace(oldCond, "");
            }
            else
            {
                var newCond = prefix + parName + "=" + condition;
                finishLine = startLine.replace(oldCond, newCond);
            }

            finishLine = "?" + finishLine.substr(1, finishLine.length);
            window.location.search = finishLine;
        }
    }
    else if(condition != "null")
    {
        var needsAmp = new String();

        if(myURL.length > 1)
        {
            needsAmp = "&";
        }

        finishLine = startLine + needsAmp + parName + "=" + condition;
        window.location.search = finishLine;
    }
}

function modifyOffset(newOffset)
{
    var modify = urlParams.has('offset');
    var finishLine = new String();
        if(modify)
        {
            var oldCond = "offset=" + p_Val[p_Enums.Offset][1];
            finishLine = locSearch.replace(oldCond, newOffset);
        }
        else
        {
            finishLine = newOffset + locSearch.replace("?", "&");
        }
    window.location.search = finishLine;
}

function navButt(input)
{
    var ajaxPostUrl = (input == "fwd" ? phpUrl.fwd : phpUrl.bck)

    $.ajax(getAjaxPost(ajaxPostUrl))
    .done(function( response ) {
                modifyOffset(response);
    });
}

function clearFilters()
{
    if(window.location.search.length > 1)
    {
        window.location.search = '';
    }
}

function sceneSelect(t_stamp)
{
    ajaxData.timestamp = t_stamp;
    $.ajax(
        {
            method: "POST",
            url: phpUrl.scene,
            data: ajaxData
        })
    .done(function( response ) {
        delete ajaxData.timestamp;
        modifyOffset(response);
    });
}