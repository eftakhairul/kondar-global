<script type="text/javascript">
    function blink(n) {
        var blinks = document.getElementsByTagName("blink");
        var visibility = n % 2 === 0 ? "visible" : "hidden";
        for (var i = 0; i < blinks.length; i++) {
            blinks[i].style.visibility = visibility;
        }
        setTimeout(function () {
            blink(n + 1);
        }, 500);
    }
    $(document).ready(function () {
        blink(1);
    });
</script>
<?php $filters = array(
                                        '<!--[if gte mso 9]><xml>
 <w:WordDocument>
  <w:View>Normal</w:View>
  <w:Zoom>0</w:Zoom>
  <w:TrackMoves></w:TrackMoves>
  <w:TrackFormatting></w:TrackFormatting>
  <w:PunctuationKerning></w:PunctuationKerning>
  <w:ValidateAgainstSchemas></w:ValidateAgainstSchemas>
  <w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid>
  <w:IgnoreMixedContent>false</w:IgnoreMixedContent>
  <w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText>
  <w:DoNotPromoteQF></w:DoNotPromoteQF>
  <w:LidThemeOther>EN-CA</w:LidThemeOther>
  <w:LidThemeAsian>ZH-CN</w:LidThemeAsian>
  <w:LidThemeComplexScript>AR-SA</w:LidThemeComplexScript>
  <w:Compatibility>
   <w:BreakWrappedTables></w:BreakWrappedTables>
   <w:SnapToGridInCell></w:SnapToGridInCell>
   <w:WrapTextWithPunct></w:WrapTextWithPunct>
   <w:UseAsianBreakRules></w:UseAsianBreakRules>
   <w:DontGrowAutofit></w:DontGrowAutofit>
   <w:SplitPgBreakAndParaMark></w:SplitPgBreakAndParaMark>
   <w:EnableOpenTypeKerning></w:EnableOpenTypeKerning>
   <w:DontFlipMirrorIndents></w:DontFlipMirrorIndents>
   <w:OverrideTableStyleHps></w:OverrideTableStyleHps>
   <w:UseFELayout></w:UseFELayout>
  </w:Compatibility>
  <m:mathPr>
   <m:mathFont m:val="Cambria Math"></m:mathFont>
   <m:brkBin m:val="before"></m:brkBin>
   <m:brkBinSub m:val="&#45;-"></m:brkBinSub>
   <m:smallFrac m:val="off"></m:smallFrac>
   <m:dispDef></m:dispDef>
   <m:lMargin m:val="0"></m:lMargin>
   <m:rMargin m:val="0"></m:rMargin>
   <m:defJc m:val="centerGroup"></m:defJc>
   <m:wrapIndent m:val="1440"></m:wrapIndent>
   <m:intLim m:val="subSup"></m:intLim>
   <m:naryLim m:val="undOvr"></m:naryLim>
  </m:mathPr></w:WordDocument>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <w:LatentStyles DefLockedState="false" DefUnhideWhenUsed="true"
  DefSemiHidden="true" DefQFormat="false" DefPriority="99"
  LatentStyleCount="267">
  <w:LsdException Locked="false" Priority="0" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Normal"></w:LsdException>
  <w:LsdException Locked="false" Priority="9" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="heading 1"></w:LsdException>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 2"></w:LsdException>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 3"></w:LsdException>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 4"></w:LsdException>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 5"></w:LsdException>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 6"></w:LsdException>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 7"></w:LsdException>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 8"></w:LsdException>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 9"></w:LsdException>
  <w:LsdException Locked="false" Priority="39" Name="toc 1"></w:LsdException>
  <w:LsdException Locked="false" Priority="39" Name="toc 2"></w:LsdException>
  <w:LsdException Locked="false" Priority="39" Name="toc 3"></w:LsdException>
  <w:LsdException Locked="false" Priority="39" Name="toc 4"></w:LsdException>
  <w:LsdException Locked="false" Priority="39" Name="toc 5"></w:LsdException>
  <w:LsdException Locked="false" Priority="39" Name="toc 6"></w:LsdException>
  <w:LsdException Locked="false" Priority="39" Name="toc 7"></w:LsdException>
  <w:LsdException Locked="false" Priority="39" Name="toc 8"></w:LsdException>
  <w:LsdException Locked="false" Priority="39" Name="toc 9"></w:LsdException>
  <w:LsdException Locked="false" Priority="35" QFormat="true" Name="caption"></w:LsdException>
  <w:LsdException Locked="false" Priority="10" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Title"></w:LsdException>
  <w:LsdException Locked="false" Priority="1" Name="Default Paragraph Font"></w:LsdException>
  <w:LsdException Locked="false" Priority="11" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Subtitle"></w:LsdException>
  <w:LsdException Locked="false" Priority="22" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Strong"></w:LsdException>
  <w:LsdException Locked="false" Priority="20" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Emphasis"></w:LsdException>
  <w:LsdException Locked="false" Priority="59" SemiHidden="false"
   UnhideWhenUsed="false" Name="Table Grid"></w:LsdException>
  <w:LsdException Locked="false" UnhideWhenUsed="false" Name="Placeholder Text"></w:LsdException>
  <w:LsdException Locked="false" Priority="1" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="No Spacing"></w:LsdException>
  <w:LsdException Locked="false" Priority="60" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Shading"></w:LsdException>
  <w:LsdException Locked="false" Priority="61" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light List"></w:LsdException>
  <w:LsdException Locked="false" Priority="62" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Grid"></w:LsdException>
  <w:LsdException Locked="false" Priority="63" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 1"></w:LsdException>
  <w:LsdException Locked="false" Priority="64" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 2"></w:LsdException>
  <w:LsdException Locked="false" Priority="65" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 1"></w:LsdException>
  <w:LsdException Locked="false" Priority="66" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 2"></w:LsdException>
  <w:LsdException Locked="false" Priority="67" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 1"></w:LsdException>
  <w:LsdException Locked="false" Priority="68" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 2"></w:LsdException>
  <w:LsdException Locked="false" Priority="69" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 3"></w:LsdException>
  <w:LsdException Locked="false" Priority="70" SemiHidden="false"
   UnhideWhenUsed="false" Name="Dark List"></w:LsdException>
  <w:LsdException Locked="false" Priority="71" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Shading"></w:LsdException>
  <w:LsdException Locked="false" Priority="72" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful List"></w:LsdException>
  <w:LsdException Locked="false" Priority="73" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Grid"></w:LsdException>
  <w:LsdException Locked="false" Priority="60" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Shading Accent 1"></w:LsdException>
  <w:LsdException Locked="false" Priority="61" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light List Accent 1"></w:LsdException>
  <w:LsdException Locked="false" Priority="62" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Grid Accent 1"></w:LsdException>
  <w:LsdException Locked="false" Priority="63" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 1"></w:LsdException>
  <w:LsdException Locked="false" Priority="64" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 1"></w:LsdException>
  <w:LsdException Locked="false" Priority="65" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 1 Accent 1"></w:LsdException>
  <w:LsdException Locked="false" UnhideWhenUsed="false" Name="Revision"></w:LsdException>
  <w:LsdException Locked="false" Priority="34" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="List Paragraph"></w:LsdException>
  <w:LsdException Locked="false" Priority="29" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Quote"></w:LsdException>
  <w:LsdException Locked="false" Priority="30" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Intense Quote"></w:LsdException>
  <w:LsdException Locked="false" Priority="66" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 2 Accent 1"></w:LsdException>
  <w:LsdException Locked="false" Priority="67" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 1"></w:LsdException>
  <w:LsdException Locked="false" Priority="68" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 1"></w:LsdException>
  <w:LsdException Locked="false" Priority="69" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 1"></w:LsdException>
  <w:LsdException Locked="false" Priority="70" SemiHidden="false"
   UnhideWhenUsed="false" Name="Dark List Accent 1"></w:LsdException>
  <w:LsdException Locked="false" Priority="71" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Shading Accent 1"></w:LsdException>
  <w:LsdException Locked="false" Priority="72" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful List Accent 1"></w:LsdException>
  <w:LsdException Locked="false" Priority="73" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Grid Accent 1"></w:LsdException>
  <w:LsdException Locked="false" Priority="60" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Shading Accent 2"></w:LsdException>
  <w:LsdException Locked="false" Priority="61" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light List Accent 2"></w:LsdException>
  <w:LsdException Locked="false" Priority="62" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Grid Accent 2"></w:LsdException>
  <w:LsdException Locked="false" Priority="63" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 2"></w:LsdException>
  <w:LsdException Locked="false" Priority="64" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 2"></w:LsdException>
  <w:LsdException Locked="false" Priority="65" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 1 Accent 2"></w:LsdException>
  <w:LsdException Locked="false" Priority="66" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 2 Accent 2"></w:LsdException>
  <w:LsdException Locked="false" Priority="67" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 2"></w:LsdException>
  <w:LsdException Locked="false" Priority="68" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 2"></w:LsdException>
  <w:LsdException Locked="false" Priority="69" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 2"></w:LsdException>
  <w:LsdException Locked="false" Priority="70" SemiHidden="false"
   UnhideWhenUsed="false" Name="Dark List Accent 2"></w:LsdException>
  <w:LsdException Locked="false" Priority="71" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Shading Accent 2"></w:LsdException>
  <w:LsdException Locked="false" Priority="72" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful List Accent 2"></w:LsdException>
  <w:LsdException Locked="false" Priority="73" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Grid Accent 2"></w:LsdException>
  <w:LsdException Locked="false" Priority="60" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Shading Accent 3"></w:LsdException>
  <w:LsdException Locked="false" Priority="61" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light List Accent 3"></w:LsdException>
  <w:LsdException Locked="false" Priority="62" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Grid Accent 3"></w:LsdException>
  <w:LsdException Locked="false" Priority="63" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 3"></w:LsdException>
  <w:LsdException Locked="false" Priority="64" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 3"></w:LsdException>
  <w:LsdException Locked="false" Priority="65" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 1 Accent 3"></w:LsdException>
  <w:LsdException Locked="false" Priority="66" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 2 Accent 3"></w:LsdException>
  <w:LsdException Locked="false" Priority="67" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 3"></w:LsdException>
  <w:LsdException Locked="false" Priority="68" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 3"></w:LsdException>
  <w:LsdException Locked="false" Priority="69" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 3"></w:LsdException>
  <w:LsdException Locked="false" Priority="70" SemiHidden="false"
   UnhideWhenUsed="false" Name="Dark List Accent 3"></w:LsdException>
  <w:LsdException Locked="false" Priority="71" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Shading Accent 3"></w:LsdException>
  <w:LsdException Locked="false" Priority="72" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful List Accent 3"></w:LsdException>
  <w:LsdException Locked="false" Priority="73" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Grid Accent 3"></w:LsdException>
  <w:LsdException Locked="false" Priority="60" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Shading Accent 4"></w:LsdException>
  <w:LsdException Locked="false" Priority="61" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light List Accent 4"></w:LsdException>
  <w:LsdException Locked="false" Priority="62" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Grid Accent 4"></w:LsdException>
  <w:LsdException Locked="false" Priority="63" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 4"></w:LsdException>
  <w:LsdException Locked="false" Priority="64" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 4"></w:LsdException>
  <w:LsdException Locked="false" Priority="65" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 1 Accent 4"></w:LsdException>
  <w:LsdException Locked="false" Priority="66" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 2 Accent 4"></w:LsdException>
  <w:LsdException Locked="false" Priority="67" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 4"></w:LsdException>
  <w:LsdException Locked="false" Priority="68" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 4"></w:LsdException>
  <w:LsdException Locked="false" Priority="69" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 4"></w:LsdException>
  <w:LsdException Locked="false" Priority="70" SemiHidden="false"
   UnhideWhenUsed="false" Name="Dark List Accent 4"></w:LsdException>
  <w:LsdException Locked="false" Priority="71" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Shading Accent 4"></w:LsdException>
  <w:LsdException Locked="false" Priority="72" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful List Accent 4"></w:LsdException>
  <w:LsdException Locked="false" Priority="73" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Grid Accent 4"></w:LsdException>
  <w:LsdException Locked="false" Priority="60" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Shading Accent 5"></w:LsdException>
  <w:LsdException Locked="false" Priority="61" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light List Accent 5"></w:LsdException>
  <w:LsdException Locked="false" Priority="62" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Grid Accent 5"></w:LsdException>
  <w:LsdException Locked="false" Priority="63" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 5"></w:LsdException>
  <w:LsdException Locked="false" Priority="64" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 5"></w:LsdException>
  <w:LsdException Locked="false" Priority="65" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 1 Accent 5"></w:LsdException>
  <w:LsdException Locked="false" Priority="66" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 2 Accent 5"></w:LsdException>
  <w:LsdException Locked="false" Priority="67" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 5"></w:LsdException>
  <w:LsdException Locked="false" Priority="68" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 5"></w:LsdException>
  <w:LsdException Locked="false" Priority="69" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 5"></w:LsdException>
  <w:LsdException Locked="false" Priority="70" SemiHidden="false"
   UnhideWhenUsed="false" Name="Dark List Accent 5"></w:LsdException>
  <w:LsdException Locked="false" Priority="71" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Shading Accent 5"></w:LsdException>
  <w:LsdException Locked="false" Priority="72" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful List Accent 5"></w:LsdException>
  <w:LsdException Locked="false" Priority="73" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Grid Accent 5"></w:LsdException>
  <w:LsdException Locked="false" Priority="60" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Shading Accent 6"></w:LsdException>
  <w:LsdException Locked="false" Priority="61" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light List Accent 6"></w:LsdException>
  <w:LsdException Locked="false" Priority="62" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Grid Accent 6"></w:LsdException>
  <w:LsdException Locked="false" Priority="63" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 6"></w:LsdException>
  <w:LsdException Locked="false" Priority="64" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 6"></w:LsdException>
  <w:LsdException Locked="false" Priority="65" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 1 Accent 6"></w:LsdException>
  <w:LsdException Locked="false" Priority="66" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 2 Accent 6"></w:LsdException>
  <w:LsdException Locked="false" Priority="67" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 6"></w:LsdException>
  <w:LsdException Locked="false" Priority="68" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 6"></w:LsdException>
  <w:LsdException Locked="false" Priority="69" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 6"></w:LsdException>
  <w:LsdException Locked="false" Priority="70" SemiHidden="false"
   UnhideWhenUsed="false" Name="Dark List Accent 6"></w:LsdException>
  <w:LsdException Locked="false" Priority="71" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Shading Accent 6"></w:LsdException>
  <w:LsdException Locked="false" Priority="72" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful List Accent 6"></w:LsdException>
  <w:LsdException Locked="false" Priority="73" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Grid Accent 6"></w:LsdException>
  <w:LsdException Locked="false" Priority="19" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Subtle Emphasis"></w:LsdException>
  <w:LsdException Locked="false" Priority="21" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Intense Emphasis"></w:LsdException>
  <w:LsdException Locked="false" Priority="31" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Subtle Reference"></w:LsdException>
  <w:LsdException Locked="false" Priority="32" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Intense Reference"></w:LsdException>
  <w:LsdException Locked="false" Priority="33" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Book Title"></w:LsdException>
  <w:LsdException Locked="false" Priority="37" Name="Bibliography"></w:LsdException>
  <w:LsdException Locked="false" Priority="39" QFormat="true" Name="TOC Heading"></w:LsdException>
 </w:LatentStyles>
</xml><![endif]--><!--[if gte mso 10]>
<style>
 /* Style Definitions */
 table.MsoNormalTable
	{mso-style-name:"Table Normal";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-parent:"";
	mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
	mso-para-margin:0cm;
	mso-para-margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;}
</style>
<![endif]-->',
                                        '<!--[if gte mso 9]><xml>
 <o:OfficeDocumentSettings>
  <o:AllowPNG></o:AllowPNG>
 </o:OfficeDocumentSettings>
</xml><![endif]-->',
                                        'mso-list:l0 level1 lfo1',
                                        'mso-list:l0;',
                                        'mso-fareast-font-family:Calibri;',
                                        'mso-fareast-font-family: Calibri;',
                                        'mso-fareast-theme-font:minor-latin;',
                                        'mso-bidi-font-family:Calibri;',
                                        ';mso-bidi-theme-font:minor-latin"',
                                        'mso-spacerun:yes"',
                                        'mso-list:Ignore'); ?>
<?php
$permanent_job = $this->comman_model->get_all_data_by_id('job_section', array('category' => 'Permanent Job', 'status' => 1));

$internship_program = $this->comman_model->get_all_data_by_id('job_section', array('category' => 'Internship Program', 'status' => 1));

$part_time = $this->comman_model->get_all_data_by_id('job_section', array('category' => 'Part Time Job', 'status' => 1));

$projects_contractors = $this->comman_model->get_all_data_by_id('job_section', array('category' => 'Projects Contractors', 'status' => 1));
?>

<?php
if ($this->session->flashdata('error')):

    $msg = $this->session->flashdata('error');
    ?>

    <script>showErrorMessage();</script>

<?php endif; ?>

<?php
$active = $_GET['active'];
if ($active == 'int_pgm') {
    $int_pgm = 'active';
} else if ($active == 'pat_job') {
    $pat_job = 'active';
} else if ($active == 'prj_cts') {
    $prj_cts = 'active';
} else {
    $per_job = 'active';
}
?>
<div class="modal fade" id="modal_success_applyform">
    <div class="modal-dialog">
        <div class="modal-content" style="position:relative;">
            <!--  <div style="position:absolute; top:0px; right:0px; z-index:99999; color:#F00;" onclick="closepopup();">Close</div>-->
            <a style="position:absolute; top:0px; right:0px; z-index:99999; color:#F00;" href="javascript:"
               onClick="$('.modal_block').modal('hide');window.location.href = 'career/index';">Close<i
                    class="block_bttn glyphicon glyphicon-chevron-right"></i></a>

            <form class="form-horizontal" role="form" action="career/apply_form/19" method="post">
                <div class="modal-body">
                    <div class="box-content-modal">
                        <h2 class="title-modal"><?php echo lang('Apply For') ?> <?php echo $apply_form['name']; ?></h2>
                        <input type="hidden" name="operation" value="set">

                        <div class="form-group">
                            <label for="salutation" class="col-sm-5 control-label"><?php echo lang('Title') ?></label>

                            <div class="col-sm-6">
                                <select name="salutation" id="salutation" style="height:35px"
                                        class="form-control selectpicker1">
                                    <option value='Mr.' data-title="Mr">Mr.</option>
                                    <option value='Ms.' data-title="Ms">Ms.</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputEmail3"
                                   class="col-sm-5 control-label"><?php echo lang('Name and Surname') ?></label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="name" id="inputEmail3"
                                       placeholder="<?php echo lang('Name and Surname') ?>"
                                       value="<?php echo set_value('name'); ?>">
                                <span style="color:#F00;"><?php echo form_error('name'); ?></span></div>
                        </div>
                        <div class="form-group">
                            <label for="countries" class="col-sm-5 control-label"><?php echo lang('Country') ?></label>

                            <div class="col-sm-6">
                                <?php $this->load->view('temp/include/countrylist'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputContact"
                                   class="col-sm-5 control-label"><?php echo lang('Telephone') ?></label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="contact" id="inputContact"
                                       placeholder="<?php echo lang('Telephone') ?>"
                                       value="<?php echo set_value('contact'); ?>">
                                <span style="color:#F00;"><?php echo form_error('contact'); ?></span></div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3"
                                   class="col-sm-5 control-label"><?php echo lang('Email') ?></label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="inputPassword3"
                                       placeholder="<?php echo lang('Email') ?>" name="email"
                                       value="<?php echo set_value('email'); ?>">
                                <span style="color:#F00;"><?php echo form_error('email'); ?></span></div>
                        </div>
                        <?php
                        if ($this->session->flashdata('success')):
                            //$msg = $this->session->flashdata('success');
                            ?>
                            <div class="notice outer">
                                <div class="note">
                                    <script type="text/javascript">$(document).ready(function () {
                                            $('#modal_success_applyform').modal('hide');
                                            $('.modal_block').modal('show');
                                        }); </script><?php echo $msg; ?> </div>
                            </div>


                        <?php
                        endif;
                        ?>
                        <?php
                        if ($this->session->flashdata('error')) :

                            //$msg = $this->session->flashdata('error');
                            ?>
                            <div class="notice outer">
                                <div class="error"><?php echo $msg; ?> </div>
                            </div>
                        <?php
                        endif;
                        ?>
                        <div class="clearfix"></div>
                        <div class="btn-modal">
                            <input style="float: right;display: block;margin-top: 10px;" type="submit" id="submitapply"
                                   value="Apply" class="btn btn-primary btn-sm"/>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade modal_block" style="overflow: auto;">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Modal title</h4>
            </div> -->
            <div class="modal-body">


                <div class="box-content-modal">
                    <h2 class="title-modal">
                        <span class="blink">Warning</span>
                    </h2>

                    <p><?php echo $msg; ?></p>

                    <div class="clearfix"></div>
                    <div class="btn-modal">
                        <a style="float:right" href="javascript:"
                           onClick="$('.modal_block').modal('hide');window.location.href = 'career/index';"
                           class="block_bttn btn btn-primary btn-sm"><?php echo lang('OK') ?> <i
                                class="glyphicon glyphicon-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div>

<div class="container">

<div class="main-page">

<div class="car-lists">

<div class="form-fill-cart dis-form">

<div class="row">

<div class="col-md-12">

<div class="promotion-page">

<!-- Nav tabs -->

<ul class="nav nav-tabs">

    <li <?php
    if (isset($per_job)) {
        echo 'class="active"';
    }
    ?>><a href="#permanent_job" data-toggle="tab" id="permanent_job1"><?php echo lang('Permanent Job') ?>
            (<?php echo count($permanent_job); ?>)</a></li>

    <li <?php
    if (isset($int_pgm)) {
        echo 'class="active"';
    }
    ?>><a href="#internship_program" data-toggle="tab" id="internship_program1"><?php echo lang('Internship Program') ?>
            (<?php echo count($internship_program); ?>)</a></li>

    <li <?php
    if (isset($pat_job)) {
        echo 'class="active"';
    }
    ?>><a href="#part_time_job" data-toggle="tab" id="part_time_job1"><?php echo lang('Part Time Job') ?>
            (<?php echo count($part_time); ?>)</a></li>

    <li <?php
    if (isset($prj_cts)) {
        echo 'class="active"';
    }
    ?>><a href="#projects_contractors" data-toggle="tab"
          id="projects_contractors1"><?php echo lang('Projects Contractors') ?>
            (<?php echo count($projects_contractors); ?>)</a></li>

</ul>


<!-- Tab panes -->

<div class="tab-content">

<div class="tab-pane <?php
if (isset($per_job)) {
    echo 'active';
}
?>" id="permanent_job">

    <div class="download-material">

        <div class="row">


            <?php
            if (isset($permanent_job) && !empty($permanent_job)):

                foreach ($permanent_job as $set_data1):

                    if (isset($set_data1['image']) && $set_data1['image'] != '') {

                        $image1 = 'assets/uploads/job_section/thumbnails/' . $set_data1['image'];
                    } else {

                        $image1 = 'assets/uploads/profile.jpg';
                    }
                    ?>

                    <div class="col-md-6">
                        <div class="media row">
                            <div class="col-md-5">
                                <img class="media-object" style="margin-bottom:0px;" src="<?php echo $image1; ?>" alt=""
                                      width="185" height="180">

                                <!--                                                                    <div class="blacktext visible-xs media-heading"><?php echo $set_data1['name']; ?></div>-->

                                <a class="btn btn-primary"
                                   href="<?php echo base_url() . 'career/apply_form/' . $set_data1['id']; ?> ">Apply</a>
                            </div>
                            <div class="col-md-7 media-body hidden-xs" style="width:55% !important;">
                                <div class="media-heading" style=""><?php echo lang('Title') ?>:</div>
                                <span><?php echo $set_data1['name']; ?></span>

                                <div class="media-heading short"><?php echo lang('Scope') ?>:</div>
                                <div class="scope_short short" style="height:90px; overflow: hidden;"><?php echo $set_data1['scope']; ?></div>
                                <div class="clearboth"></div>
                                <div class="hidden_lite show_page_<?php echo $set_data1['id']; ?>">
                                    <div class="media-heading" style=""><?php echo lang('Scope') ?>:</div>
                                   
                                    <?php
                                    foreach ($filters as $filter) {
                                        $set_data1['scope'] = str_ireplace($filter, '', $set_data1['scope']);
                                    }
                                    echo $set_data1['scope'];
                                    ?>
                                    <br/>

                                    <div class="clearboth"></div>
                                    <div class="media-heading" style=""><?php echo lang('Qualification') ?>:</div>
                                    <?php
                                    foreach ($filters as $filter) {
                                        $set_data1['qualification'] = str_ireplace($filter, '', $set_data1['qualification']);
                                    }
                                    echo $set_data1['qualification'];
                                    ?>
                                    <div class="clearboth"></div>
                                </div>
                                <a class="show_page " style="color:red;" id="page_<?php echo $set_data1['id']; ?>"
                                   data-value="<?php echo $set_data1['id']; ?>"
                                   href="javascript:"><?php echo lang('Read'); ?> <span
                                        class="moretext"><?php echo lang('More') ?></span><span
                                        class="lesstext"><?php echo lang('Less') ?></span> <?php echo lang('About') ?> <?php echo $set_data1['name']; ?>
                                </a>
                            </div>
                        </div>
                        <!--                                                            <div class="row">
                                                                                                                            <div class="col-md-5">
                                                                                                                                <a class="btn btn-primary" href="<?php echo base_url() . 'career/apply_form/' . $set_data1['id']; ?> ">Apply</a>
                                                                                                                            <div class="btn btn-primary" onclick="hello(<?php echo $set_data1['id']; ?>);">Apply</div>
                                                                                                                            </div>
                                                                                                                            <div class="col-md-7">
                                                                                                                            
                                                                                                                            </div>
                                                                                                                        </div>-->

                    </div>





                <?php
                endforeach;

            endif;
            ?>

        </div>

    </div>

</div>
<!--End download-material-->

<div class="tab-pane <?php
if (isset($int_pgm)) {
    echo 'active';
}
?>" id="internship_program">

    <div class="download-material">

        <div class="row">

            <?php
            if (isset($internship_program) && !empty($internship_program)) {

                foreach ($internship_program as $set_data2) {

                    if (isset($set_data2['image']) && $set_data2['image'] != '') {

                        $image2 = 'assets/uploads/job_section/thumbnails/' . $set_data2['image'];
                    } else {

                        $image2 = 'assets/uploads/profile.JPG';
                    }
                    ?>

                    <div class="col-md-6">

                        <div class="media">

                            <a class="pull-left" href="career/apply_form/<?php echo $set_data2['id']; ?>">

                                <img class="media-object" src="<?php echo $image2; ?>" alt="" width="169" height="180">

                                <p class="blacktext visible-xs media-heading"><?php echo $set_data2['name']; ?></p>

                                <span class="btn btn-primary">Apply</span>

                            </a>


                            <div class="media-body hidden-xs">

                                <div class="media-heading" style=""><?php echo lang('Title') ?>:</div>

                                <span><?php echo $set_data2['name']; ?></span>

                                <div class="media-heading short" style=""><?php echo lang('Scope') ?>:</div>
                                <div class="scope_short short" style="height:90px; overflow: hidden;"><?php echo $set_data2['scope']; ?></div>
                                <div class="clearboth"></div>
                                <div class="hidden_lite show_page_<?php echo $set_data2['id']; ?>">
                                    <div class="media-heading" style=""><?php echo lang('Scope') ?>:
                                    </div><?php echo $set_data2['scope']; ?>
                                    <br/>
                                    <div class="clearboth"></div>
                                    <div class="media-heading" style=""><?php echo lang('Qualification') ?>:
                                    </div><?php echo $set_data2['qualification']; ?>
                                    <div class="clearboth"></div>
                                </div>

                                <br/>

                                <a class="readmore show_page" id="page_<?php echo $set_data2['id']; ?>"
                                   data-value="<?php echo $set_data2['id']; ?>"
                                   href="javascript:"><?php echo lang('Read').' '; ?> <span
                                        class="moretext"><?php echo lang('More') ?></span><span
                                        class="lesstext"><?php echo lang('Less') ?></span> <?php echo lang('About') ?> <?php echo $set_data2['name']; ?>
                                </a>

                            </div>

                        </div>

                    </div>

                <?php
                }
            }
            ?>

        </div>

    </div>

</div>

<div class="tab-pane <?php
if (isset($pat_job)) {
    echo "active";
}
?>" id="part_time_job">

    <div class="download-material">

        <div class="row">

            <?php
            if (isset($part_time) && !empty($part_time)) {

                foreach ($part_time as $set_data3) {

                    if (isset($set_data3['image']) && $set_data3['image'] != '') {

                        $image3 = 'assets/uploads/job_section/thumbnails/' . $set_data3['image'];
                    } else {

                        $image3 = 'assets/uploads/profile.JPG';
                    }
                    ?>

                    <div class="col-md-6">

                        <div class="media">

                            <a class="pull-left" href="career/apply_form/<?php echo $set_data3['id']; ?>">

                                <img class="media-object" src="<?php echo $image3; ?>" alt="" width="169" height="180">

                                <p class="blacktext visible-xs media-heading"><?php echo $set_data3['name']; ?></p>

                                <span class="btn btn-primary">Apply</span>

                            </a>


                            <div class="media-body hidden-xs">

                                <div class="media-heading" style=""><?php echo lang('Title') ?>:</div>

                                <span><?php echo $set_data3['name']; ?></span>

                                <div class="media-heading short" style=""><?php echo lang('Scope') ?>:</div>


                                <div class="scope_short short" style="height:90px; overflow: hidden;"><?php echo $set_data3['scope']; ?></div>
                                <div class="clearboth"></div>

                                <div class="hidden_lite show_page_<?php echo $set_data3['id']; ?>">

                                    <div class="media-heading" style=""><?php echo lang('Scope') ?>:
                                    </div><?php echo $set_data3['scope']; ?>

                                    <br/>

                                    <div class="clearboth"></div>

                                    <div class="media-heading" style=""><?php echo lang('Qualification') ?>:
                                    </div><?php echo $set_data3['qualification']; ?>

                                    <div class="clearboth"></div>

                                </div>

                                <br/>

                                <a class="readmore show_page" id="page_<?php echo $set_data3['id']; ?>"
                                   data-value="<?php echo $set_data3['id']; ?>" href=""><?php echo lang('Read').' '; ?><span
                                        class="moretext"><?php echo lang('More') ?></span><span
                                        class="lesstext"><?php echo lang('Less') ?></span> <?php echo lang('About') ?> <?php echo $set_data3['name']; ?>
                                </a>

                            </div>

                        </div>

                    </div>

                <?php
                }
            }
            ?>

        </div>

    </div>

</div>

<div class="tab-pane <?php
if (isset($prj_cts)) {
    echo 'active';
}
?>" id="projects_contractors">

    <div class="download-material">

        <div class="row">

            <?php
            if (isset($projects_contractors) && !empty($projects_contractors)):

                foreach ($projects_contractors as $set_data4):

                    if (isset($set_data4['image']) && $set_data4['image'] != '') {

                        $image4 = 'assets/uploads/job_section/thumbnails/' . $set_data4['image'];
                    } else {

                        $image4 = 'assets/uploads/profile.JPG';
                    }
                    ?>

                    <div class="col-md-6">

                        <div class="media">

                            <a class="pull-left" href="career/apply_form/<?php echo $set_data4['id']; ?>">

                                <img class="media-object" src="<?php echo $image4; ?>" alt="" width="169" height="180">

                                <p class="blacktext visible-xs media-heading"><?php echo $set_data4['name']; ?></p>

                                <span class="btn btn-primary">Apply</span>

                            </a>


                            <div class="media-body hidden-xs">

                                <div class="media-heading" style=""><?php echo lang('Title') ?>:</div>

                                <span><?php echo $set_data4['name']; ?></span>

                                <div class="media-heading short" style=""><?php echo lang('Scope') ?>:</div>

                                <div class="scope_short short" style="height:90px; overflow: hidden;"><?php echo $set_data4['scope']; ?></div>
                                <div class="clearboth"></div>
                                <div class="hidden_lite show_page_<?php echo $set_data4['id']; ?>">

                                    <div class="media-heading" style=""><?php echo lang('Scope') ?>:
                                    </div><?php echo $set_data4['scope']; ?>

                                    <br/>

                                    <div class="clearboth"></div>

                                    <div class="media-heading" style=""><?php echo lang('Qualification') ?>:
                                    </div><?php echo $set_data4['qualification']; ?>

                                    <div class="clearboth"></div>

                                </div>

                                <br/>

                                <a class="readmore show_page" id="page_<?php echo $set_data4['id']; ?>"
                                   data-value="<?php echo $set_data4['id']; ?>" href=""><?php echo lang('Read').' '; ?><span
                                        class="moretext"><?php echo lang('More') ?></span><span
                                        class="lesstext"><?php echo lang('Less') ?></span> <?php echo lang('About') ?> <?php echo $set_data4['name']; ?>
                                </a>

                            </div>

                        </div>

                    </div>



                <?php
                endforeach;

            endif;
            ?>
        </div>
    </div>
</div>
<!--End knowledge center-->
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!--End content-->
</div>
<div class="modal fade modal_block">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box-content-modal">
                    <h2 class="title-modal"><span class="blink">Warning</span></h2>

                    <p><?php echo lang('Sorry your email ID has been blocked for 120 minutes.') ?></p>

                    <div class="clearfix"></div>
                    <div class="btn-modal">
                        <a style="float:right" href="javascript:" onClick="$('.modal_block').modal('hide')"
                           class="block_bttn btn btn-primary btn-sm">OK <i
                                class="glyphicon glyphicon-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        function clearMso() {
            $('.MsoNormal').each(function (index) {
                $(this).removeClass('.MsoNormal');
            });
        }

        setInterval(clearMso(), 500);
    });
</script>