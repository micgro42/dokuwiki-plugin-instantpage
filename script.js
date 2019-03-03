jQuery(function () {
    function getUrlParams(url) {
        const params = {};
        if (url.indexOf('?') === -1) {
            return {};
        }
        const query = url.split('?', 2)[1];
        query.split('&').forEach(function(element){
            const [key, value] = element.split('=');
            params[key] = value;
        });
        return params;
    }
    console.log('I ran!');
    jQuery('a').each(function () {
        var href = this.href;
        if (href.indexOf('?') === -1) {
            // Links with query string are already handled correctly
            return;
        }
        const params = getUrlParams(href);
        if (params['do'] && params['do'] !== '' && params['do'] !== 'show') {
            // don't prefetch actions other than show
            return;
        }
        jQuery(this).attr('data-instant', 1);
    });

    /* DOKUWIKI:include scripts/instantpage.js */
});
