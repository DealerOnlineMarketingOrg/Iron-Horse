<style type="text/css">.example {outline:1px dashed #CCC;padding:.5em 1em}</style>
<div class="wrapper content-padding">
    <div id="styleguide" class="content-page block">
        <h2>Styleguide</h2>
    	<section>
        <p>This document is a guide to the mark-up styles used throughout the site.</p>
        <h2>Sections</h2>
        <p>The logo is the <code>h1</code> element. Any header elements may include links, as depicted in the example.</p>
        <p>The header above is an <code>h2</code> element, which may be used for any form of important page-level header. More than one may be used per page. Consider using an <code>h2</code> unless you need a header level of less importance, or as a sub-header to an existing <code>h2</code> element.</p>
        <h3>Third-Level Header</h3>
        <p>The header above is an <code>h3</code> element, which may be used for any form of page-level header which falls below the <code>h2</code> header in a document hierarchy.</p>
        <h4>Fourth-Level Header</h4>
        <p>The header above is an <code>h4</code> element, which may be used for any form of page-level header which falls below the <code>h3</code> header in a document hierarchy.</p>
        <h5>Fifth-Level Header</h5>
        <p>The header above is an <code>h5</code> element, which may be used for any form of page-level header which falls below the <code>h4</code> header in a document hierarchy.</p>
        <h6>Sixth-Level Header</h6>
        <p>The header above is an <code>h6</code> element, which may be used for any form of page-level header which falls below the <code>h5</code> header in a document hierarchy.</p>
       </section>
		<section>
        <!--Grouping Content-->
        <h2>Grouping Content</h2>
        <h3>Paragraphs</h3>
        <p>All paragraphs are wrapped in <code>p</code> tags. Additionally, <code>p</code> elements can be wrapped with a <code>blockquote</code> element <em>if the <code>p</code> element is indeed a quote</em>. Historically, <code>blockquote</code> has been used purely to force indents, but this is now achieved using CSS. Reserve <code>blockquote</code> for quotes.</p>
        <h3>Horizontal Rule</h3>
        <p>The <code>hr</code> element represents a paragraph-level thematic break, e.g. a scene change in a story, or a transition to another topic within a section of a reference book. The following extract from <cite>Pandora’s Star</cite> by Peter F. Hamilton shows two paragraphs that precede a scene change and the paragraph that follows it:</p>
        
        	<p>Dudley was ninety-two, in his second life, and fast approaching time for another rejuvenation. Despite his body having the physical age of a standard fifty-year-old, the prospect of a long degrading campaign within academia was one he regarded with dread. For a supposedly advanced civilization, the Intersolar Commonwearth could be appallingly backward at times, not to mention cruel.</p>
            <p>Maybe it won’t be that bad, he told himself. The lie was comforting enough to get him through the rest of the night’s shift.</p>
            <hr />
            <p>The Carlton AllLander drove Dudley home just after dawn. Like the astronomer, the vehicle was old and worn, but perfectly capable of doing its job. It had a cheap diesel engine, common enough on a semi-frontier world like Gralmond, although its drive array was a thoroughly modern photoneural processor. With its high suspension and deep-tread tyres it could plough along the dirt track to the observatory in all weather and seasons, including the metre-deep snow of Gralmond’s winters.</p>
        </section>
        <section>
        <h3>Pre-formatted Text</h3>
        <p>The <code>pre</code> element represents a block of pre-formatted text, in which structure is represented by typographic conventions rather than by elements. Such examples are an e-mail (with paragraphs indicated by blank lines, lists indicated by lines prefixed with a bullet), fragments of computer code (with structure indicated according to the conventions of that language) or displaying <abbr title="American Standard Code for Information Interchange">ASCII</abbr> art. Here’s an example showing the printable characters of <abbr>ASCII</abbr>:</p>
        <div class="example">
        	<pre><samp>  ! " # $ % &amp; ' ( ) * + , - . /
                    0 1 2 3 4 5 6 7 8 9 : ; &lt; = &gt; ?
                    @ A B C D E F G H I J K L M N O
                    P Q R S T U V W X Y Z [ \ ] ^ _
                    ` a b c d e f g h i j k l m n o
                    p q r s t u v w x y z { | } ~ </samp></pre>
        </div>
        </section>
        <section>
        <h3>Blockquotes</h3>
        <p>The <code>blockquote</code> element represents a section that is being quoted from another source.</p>
        <div class="example">
			<blockquote cite="http://hansard.millbanksystems.com/commons/1947/nov/11/parliament-bill#column_206">
				<p>Many forms of Government have been tried, and will be tried in this world of sin and woe. No one pretends that democracy is perfect or all-wise. Indeed, it has been said that democracy is the worst form of government except all those other forms that have been tried from time to time.</p>
			</blockquote>
			<p>Winston Churchill, in <cite><a href="http://hansard.millbanksystems.com/commons/1947/nov/11/parliament-bill#column_206">a speech to the House of Commons</a></cite>. 11th November 1947</p>
		</div>
		<p>Additionally, you might wish to cite the source, as in the above example. The correct method involves including the
<code>cite</code>attribute on the <code>blockquote</code>element, but since no browser makes any use of that information, it’s useful to link to the source also.</p>   
		</section>
        <section>     
        <h3>Ordered List</h3>
        <p>The <code>ol</code> element denotes an ordered list, and various numbering schemes are available through the CSS (including 1,2,3… a,b,c… i,ii,iii… and so on). Each item requires a surrounding <code>li</code> and <code>/li</code> tag, to denote individual items within the list (as you may have guessed, <code>li</code> stands for list item).</p>
        <div class="example">
			<ol>
				<li>This is an ordered list.</li>
				<li>This is the second item, which contains a sub list
					<ol>
						<li>This is the sub list, which is also ordered.</li>
						<li>It has two items.</li>
					</ol>
				</li>
				<li>This is the final item on this list.</li>
			</ol>
		</div>
        </section>
        <section>
        <h3>Unordered List</h3>
        <p>The <code>ul</code> element denotes an unordered list (ie. a list of loose items that don’t require numbering, or a bulleted list). Again, each item requires a surrounding <code>li</code> and <code>/li</code> tag, to denote individual items. Here is an example list showing the constituent parts of the British Isles:</p>
        <div class="example">
			<ul>
				<li>United Kingdom of Great Britain and Northern Ireland:
					<ul>
						<li>England</li>
						<li>Scotland</li>
						<li>Wales</li>
						<li>Northern Ireland</li>
					</ul>
				</li>
				<li>Republic of Ireland</li>
				<li>Isle of Man</li>
				<li>Channel Islands:
					<ul>
						<li>Bailiwick of Guernsey</li>
						<li>Bailiwick of Jersey</li>
					</ul>
				</li>
			</ul>
		</div>
        <p>Sometimes we may want each list item to contain block elements, typically a paragraph or two.</p>
        <div class="example">
			<ul>
				<li>
					<p>The British Isles is an archipelago consisting of the two large islands of Great Britain and Ireland, and many smaller surrounding islands.</p>
				</li>
				<li>
				<p>Great Britain is the largest island of the archipelago. Ireland is the second largest island of the archipelago and lies directly to the west of Great Britain.</p>
				</li>
				<li>
				<p>The full list of islands in the British Isles includes over 1,000 islands, of which 51 have an area larger than 20 km <sup>2</sup>.</p>
				</li>
			</ul>
		</div>
        </section>
        <section>
        <h3>Definition List</h3>
        <p>The <code>dl</code> element is for another type of list called a definition list. Instead of list items, the content of a <code>dl</code> consists of <code>dt</code> (Definition Term) and <code>dd</code> (Definition description) pairs. Though it may be called a “definition list”, <code>dl</code> can apply to other scenarios where a parent/child relationship is applicable. For example, it may be used for marking up dialogues, with each <code>dt</code> naming a speaker, and each <code>dd</code> containing his or her words.</p>
        <div class="example">
			<dl>
				<dt>This is a term.</dt>
				<dd>This is the definition of that term, which both live in a <code>dl</code>.</dd>
				<dt>Here is another term.</dt>
				<dd>And it gets a definition too, which is this line.</dd>
				<dt>Here is term that shares a definition with the term below.</dt>
				<dt>Here is a defined term.</dt>
				<dd><code>dt</code> terms may stand on their own without an accompanying <code>dd</code>, but in that case they <em>share</em> descriptions with the next available <code>dt</code>. You may not have a <code>dd</code> without a parent <code>dt</code>.
				</dd>
			</dl>
		</div>
        </section>
        <section>
        <h3>Figures</h3>
        <p>Figures are usually used to refer to images:</p>
        <div class="example">
			<figure>
				<img alt="Example image" src="http://lorempixum.com/680/400/abstract/?r">
					<figcaption>
						<h4>Figure Heading</h4>
						<p>This is a placeholder image, with supporting caption.</p>
					</figcaption>
			</figure>
		</div>
        <p>Here, a part of a poem is marked up using figure:</p>
        <div class="example">
			<figure>
				<p>‘Twas brillig, and the slithy toves <br> Did gyre and gimble in the wabe; <br> All mimsy were the borogoves,<br>And the mome raths outgrabe.</p>
				<figcaption>
					<p><cite>Jabberwocky</cite>(first verse). Lewis Carroll, 1832-98</p>
				</figcaption>
			</figure>
		</div>
        
        <h2>Text-level Semantics</h2>
        <p>There are a number of inline <abbr title="HyperText Markup Language">HTML</abbr> elements you may use anywhere within other elements.</p>
        </section>
        <section>
        <h3>Links and Anchors</h3>
        <p>The <code>a</code> element is used to hyperlink text, be that to another page, a named fragment on the current page or any other location on the web. Example:</p>
        <div class="example prose">
			<p><a href="/">Go to the home page </a>or<a href="#banner"> return to the top of this page</a>.</p>
		</div>
        </section>
        <section>
        <h3>Stressed Emphasis</h3>
        <p>The <code>em</code> element is used to denote text with stressed emphasis, i.e., something you’d pronounce differently. Where italicizing is required for stylistic differentiation, the <code>i</code> element may be preferable. Example:</p>
        <div class="example">
			<p>You simply <em>must</em> try the negitoro maki!</p>
		</div>
        </section>
        <section>
        <h3>Strong Importance</h3>
        <p>The <code>strong</code> element is used to denote text with strong importance. Where bolding is used for stylistic differentiation, the <code>b</code> element may be preferable. Example:</p>
        <div class="example">
			<p><strong>Don’t</strong> stick nails in the electrical outlet.</p>
		</div>
        </section>
        <section>
        <h3>Small Print</h3>
        <p>The <small>small</small> element is used to represent disclaimers, caveats, legal restrictions, or copyrights (commonly referred to as ‘small print’). It can also be used for attributions or satisfying licensing requirements. Example:</p>
        <div class="example">
			<p><small>Copyright © 1922-2011 Acme Corporation. All Rights Reserved.</small></p>
		</div>
        </section>
        <section>
        <h3>Strikethrough</h3>
        <p>The <code>s</code> element is used to represent content that is no longer accurate or relevant. When indicating document edits i.e., marking a span of text as having been removed from a document, use the <code>del</code> element instead. Example:</p>
        <div class="example">
			<p><s>Recommended retail price: £3.99 per bottle</s><br><strong>Now selling for just £2.99 a bottle!</strong></p>
		</div>
        </section>
        <section>
        <h3>Citations</h3>
        <p>The <code>cite</code> element is used to represent the title of a work (e.g. a book, essay, poem, song, film, TV show, sculpture, painting, musical, exhibition, etc). This can be a work that is being quoted or referenced in detail (i.e. a citation), or it can just be a work that is mentioned in passing. Example:</p>
        <div class="example">
			<p><cite>Universal Declaration of Human Rights</cite>, United Nations, December 1948. Adopted by General Assembly resolution 217 A (III).</p>
		</div>
        </section>
        <section>
        <h3>Definition</h3>
        <p>The <code>dfn</code> element is used to highlight the first use of a term. The <code>title</code> attribute can be used to describe the term. Example:</p>
        <div class="example">
			<p>Bob’s <dfn title="Dog">canine</dfn> mother and <dfn title="Horse">equine</dfn> father sat him down and carefully explained that he was an<dfn title="A mutation that combines two or more sets of chromosomes from different species"> allopolyploid</dfn> organism.</p>
		</div>
        </section>
        <section>
        <h3>Abbreviation</h3>
        <p>The <code>abbr</code> element is used for any abbreviated text, whether it be acronym, initialism, or otherwise. Generally, it’s less work and useful (enough) to mark up only the first occurrence of any particular abbreviation on a page, and ignore the rest. Any text in the <code>title</code> attribute will appear when the user’s mouse hovers the abbreviation (although notably, this does not work in Internet Explorer for Windows). Example abbreviations:</p>
        <div class="example">
			<p><abbr title="British Broadcasting Corportation">BBC</abbr>, <abbr title="HyperText Markup Language">HTML</abbr>, and <abbr title="Staffordshire">Staffs.</abbr></p>
		</div>
        </section>
        <section>
        <h3>Time</h3>
        <p>The <code>time</code> element is used to represent either a time on a 24 hour clock, or a precise date in the proleptic Gregorian calendar, optionally with a time and a time-zone offset. Example:</p>
        <div class="example"><p>Queen Elizabeth II was proclaimed sovereign of each of the Commonwealth realms on <time datetime="1952-02-6">6</time> and <time datetime="1952-02-7">7 February 1952</time>, after the death of her father, King George VI.</p>
		</div>
        </section>
        <section>
        <h3>Code</h3>
        <p>The <code>code</code> element is used to represent fragments of computer code. Useful for technology-oriented sites, not so useful otherwise. Example:</p>
        <div class="example">
			<p>When you call the <code>activate()</code> method on the <code>robotSnowman</code> object, the eyes glow.</p>
		</div>
        <p>Used in conjunction with the <code>pre</code> element:</p>
        <div class="example">
			<pre><code>function getJelly() {
                        echo $aDeliciousSnack;
                    }</code></pre>
		</div>
        <p>Shown with line numbers:</p>
        <div class="example">
			<ol class="code">
				<li><code>< ?php </code></li>
				<li class="tab1"><code>echo 'Hello World!';</code></li>
				<li><code>?></code></li>
			</ol>
		</div>
        </section>
        <section>
        <h3>Variable</h3>
        <p>The <code>var</code> element is used to denote a variable in a mathematical expression or programming context, but can also be used to indicate a placeholder where the contents should be replaced with your own value. Example:</p>
        <div class="example">
			<p>If there are <var>n</var> pipes leading to the ice cream factory then I expect at <em>least</em> <var>n</var> flavours of ice cream to be available for purchase!</p>
		</div>
        </section>
        <section>
        <h3>Sample output</h3>
        <p>The <code>samp</code> element is used to represent (sample) output from a program or computing system. Useful for technology-oriented sites, not so useful otherwise. Example:</p>
        <div class="example">
			<p>The computer said <samp>Too much cheese in tray two</samp> but I didn’t know what that meant.</p>
		</div>
        </section>
        <section>
        <h3>Keyboard entry</h3>
        <p>The <code>kbd</code> element is used to denote user input (typically via a keyboard, although it may also be used to represent other input methods, such as voice commands). Example:</p>
        <div class="example">
			<p>To take a screenshot on your Mac, press <kbd>⌘ Cmd</kbd> + <kbd>⇧ Shift</kbd> + <kbd>3</kbd>.</p>
		</div>
        </section>
        <section>
        <h3>Superscript and subscript text</h3>
        <p>The <code>sup</code> element represents a superscript and the sub element represents a <code>sub</code>. These elements must be used only to mark up typographical conventions with specific meanings, not for typographical presentation. As a guide, only use these elements if their absence would change the meaning of the content. Example:</p>
        <div class="example">
			<p>The coordinate of the <var>i</var> th point is ( <var> x <sub><var>i</var></sub></var>, <var> y <sub><var>i</var></sub></var>). For example, the 10th point has coordinate ( <var> x <sub>10</sub></var>, <var> y<sub>10</sub></var>).</p>
			<p>f(<var>x</var>,<var>n</var>) = log<sub>4</sub><var>x</var><sup><var>n</var></sup></p>
		</div>
        </section>
        <section>
        <h3>Italicised</h3>
        <p>The <code>i</code> element is used for text in an alternate voice or mood, or otherwise offset from the normal prose. Examples include taxonomic designations, technical terms, idiomatic phrases from another language, the name of a ship or other spans of text whose typographic presentation is typically italicised. Example:</p>
        <div class="example">
			<p>There is a certain <i lang="fr">je ne sais quoi</i> in the air.</p>
		</div>
        </section>
        <section>
        <h3>Emboldened</h3>
        <p>The <code>b</code> element is used for text stylistically offset from normal prose without conveying extra importance, such as key words in a document abstract, product names in a review, or other spans of text whose typographic presentation is typically emboldened. Example:</p>
        <div class="example">
			<p>You enter a small room. Your <b>sword</b> glows brighter. A <b>rat</b> scurries past the corner wall.</p>
		</div>
        </section>
        <section>
        <h3>Marked or highlighted text</h3>
        <p>The <code>mark</code> element is used to represent a run of text marked or highlighted for reference purposes. When used in a quotation it indicates a highlight not originally present but added to bring the reader’s attention to that part of the text. When used in the main prose of a document, it indicates a part of the document that has been highlighted due to its relevance to the user’s current activity. Example:</p>
        <div class="example">
			<p>I also have some <mark>kitten</mark> s who are visiting me these days. They’re really cute. I think they like my garden! Maybe I should adopt a <mark>kitten</mark>.</p>
		</div>
        </section>
        <section>
        <h3 id="edits">Edits</h3>
        <p>The <code>del</code> element is used to represent deleted or retracted text which still must remain on the page for some reason. Meanwhile its counterpart, the <code>ins</code> element, is used to represent inserted text. Both <code>del</code> and <code>ins</code> have a <code>datetime</code> attribute which allows you to include a timestamp directly in the element. Example inserted text and usage:</p>
        <div class="example">
			<p>She bought <del datetime="2005-05-30T13:00:00">two</del><ins datetime="2005-05-30T13:00:00">five</ins> pairs of shoes.</p>
		</div>
        </section>
        <section>
        <h2 id="tables">Tabular data</h2>
        <p>Tables should be used when displaying tabular data. The <code>thead</code>, <code>tfoot</code> and <code>tbody</code> elements enable you to group rows within each a table.</p>
        <p>If you use these elements, you must use every element. They should appear in this order:<code>thead</code>,<code>tfoot</code>and <code>tbody</code>, so that browsers can render the foot before receiving all the data. You must use these tags within the table element.</p>
        <div class="example">
			<table>
				<caption>The Very Best Eggnog</caption>
					<colgroup>
                    	<col style="width:15em;">
                        <col style="width:6em;">
                        <col style="width:6em;">
					</colgroup>
				<thead>
					<tr>
						<th scope="col">Ingredients</th>
						<th scope="col">Serves 12</th>
						<th scope="col">Serves 24</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Milk</td>
						<td>1 quart</td>
						<td>2 quart</td>
					</tr>
					<tr>
						<td>Cinnamon Sticks</td>
						<td>2</td>
						<td>1</td>
					</tr>
					<tr>
						<td>Vanilla Bean, Split</td>
						<td>1</td>
						<td>2</td>
					</tr>
					<tr>
						<td>Cloves</td>
						<td>5</td>
						<td>10</td>
					</tr>
					<tr>
						<td>Mace</td>
						<td>10 blades</td>
						<td>20 blades</td>
					</tr>
					<tr>
						<td>Egg Yolks</td>
						<td>12</td>
						<td>24</td>
					</tr>
					<tr>
						<td>Cups Sugar</td>
						<td>1 ½ cups</td>
						<td>3 cups</td>
					</tr>
					<tr>
						<td>Dark Rum</td>
						<td>1 ½ cups</td>
						<td>3 cups</td>
					</tr>
					<tr>
						<td>Brandy</td>
						<td>1 ½ cups</td>
						<td>3 cups</td>
					</tr>
					<tr>
						<td>Vanilla</td>
						<td>1 tbsp</td>
						<td>2 tbsp</td>
					</tr>
					<tr>
						<td>Half-and-half or Light Cream</td>
						<td>1 quart</td>
						<td>2 quart</td>
					</tr>
					<tr>
						<td>Freshly grated nutmeg to taste</td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
			</table>
		</div>
        </section>
        <section>
        <h2 id="forms">Forms</h2>
        <p>Forms can be used when you wish to collect data from users. The <code>fieldset</code> element enables you to group related fields within a form, and each one should contain a corresponding <code>legend</code>. The <code>label</code> element ensures field descriptions are associated with their corresponding form widgets.</p>
        <div class="example">
			<form action="#">
				<fieldset>
					<legend>Legend</legend>
						<div><label for="text">Text Input<abbr title="Required">*</abbr></label>
								<input id="text" class="text" type="text"><em>Note about this field</em>
						</div>
						<div><label for="password">Password</label>
								<input id="password" class="text" type="password"><em>Note about this field</em>
						</div>
						<div><label for="url">Web Address</label>
								<input id="url" class="text" type="url"><em>Note about this field</em>
						</div>
						<div><label for="email">Email Address</label>
								<input id="email" class="text" type="email"><em>Note about this field</em>
						</div>
						<div><label for="search">Search</label>
								<input id="search" class="text" type="search">
								<input id="password" class="search sprite" type="submit"><em>Note about this field</em>
						</div>
						<div><label for="textarea">Textarea</label>
								<textarea id="textarea" cols="48" rows="8"></textarea><em class="clear">Note about this field</em>
						</div>
						<div><label for="checkbox">Single Checkbox</label>
                        	 	<label class="check" for="checkbox"><input id="checkbox" class="checkbox" type="checkbox">Label</label>
						</div>
						<div><label for="select">Select</label>
								<select id="select">
									<optgroup label="Option Group">
										<option>Option One</option>
										<option>Option Two</option>
										<option>Option Three</option>
									</optgroup>
								</select>
							<em>Note about this selection</em>
						</div>
					<fieldset class="options">
						<legend>
                        	Checkbox
                            <abbr title="Required">*</abbr>
                        </legend>
							<div>
								<label for="checkbox1">
									<input id="checkbox1" type="checkbox" checked="checked" name="checkbox">
									Choice A
								</label>
								<label for="checkbox2">
									<input id="checkbox2" type="checkbox" name="checkbox">
									Choice B
								</label>
								<label for="checkbox3">
									<input id="checkbox3" type="checkbox" name="checkbox">
									Choice C
								</label>
							</div>
					</fieldset>
					<fieldset class="options">
						<legend>Radio</legend>
							<div>
								<label for="radio1">
									<input id="radio1" class="radio" type="radio" checked="checked" name="radio">
									Option 1
								</label>
								<label for="radio2">
									<input id="radio2" class="radio" type="radio" name="radio">
									Option 2
								</label>
							</div>
					</fieldset>
					<div class="submit">
						<input class="button green" type="submit" value="Post Comment">
						<input class="button green" type="button" value="Preview">
						<a href="#">Cancel</a>
					</div>
				</fieldset>
			</form>
		</div>
        </section>
        <section>
        <h2 id="forms">Patterns</h2>
        <p>Design and mark-up patterns unique to this site.</p>
        
		<h3>Pagination</h3>
        <p>Used to navigate between pages of search results.</p>
        <ul class="pagination" role="navigation">
			<li>
				<a rel="prev" href="#">Previous</a>
			</li>
			<li>
				<a href="#">1</a>
			</li>
			<li>
				<span class="active">2</span>
			</li>
			<li>
				<a href="#">3</a>
			</li>
			<li>
				<a href="#">4</a>
			</li>
			<li>
				<a rel="next" href="#">Next</a>
			</li>
		</ul>
        </section>
        <section>
        <h3>Notification Message</h3>
		<p>Used to highlight a particular message or action.</p>
        <div class="notification message">
			<h4>I’m running the Brighton Marathon on Sunday, April 15th 2012</h4>
				<p>By doing so, I hope to raise £500 for Action for Children. Sponsorship will not only motivate me on the big day, but help thousands of children across the UK reach their full potential.</p>
				<p><a class="action" href="http://www.justgiving.com/prlrun2012/">Sponsor my run on Just Giving ›</a></p>
		</div>
        </section>
    </div>
</div>