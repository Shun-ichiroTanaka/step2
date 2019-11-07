import marked from 'marked';


// マークダウンをプレビュー画面に表示
$(function() {
	marked.setOptions({
		langPrefix: '',
		breaks : true,
		sanitize: true,
	});

    // テキストエリア（id="markdown_editor_textarea")に文字が打ち込まれていったら、
    // テキストエリアの文字を取得してmarkdownをHTMLに変換します。
    // その後、プレビューに表示を実行
	$('#markdown_editor_textarea').keyup(function() {
		var html = marked(getHtml($(this).val()));
		$('#markdown_preview').html(html);
	});

    // 個別の記事画面のマークダウンをHTMLに変換する
    // var target = $('.item-body')で、item-bodyがクラスのものを取得して、
    // marked.jsを使用してマークダウンをHTMLに変換
    // $('.item-body').html(html);で、
    // もう一度クラスがitem-bodyの所にHTMLを返してあげる
    var target = $('.c-post__show-body')
    var html = marked(getHtml(target.html()));
    $('.c-post__show-body').html(html);


	// 比較演算子が &lt; 等になるので置換
	function getHtml(html) {
		html = html.replace(/&lt;/g, '<');
		html = html.replace(/&gt;/g, '>');
		html = html.replace(/&amp;/g, '&');
		return html;
	}
});