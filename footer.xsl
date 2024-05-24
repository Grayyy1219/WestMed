<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <footer>
            <div class="footer">
                <div class="all-footer">
                    <!-- CUSTOMER SERVICE -->
                    <div class="CUSTOMER-SERVICE">
                        <div class="text-wrapper">test</div>
                        <div class="frame3">
                            <!-- Payment Methods -->
                            <div class="list-item-link">
                                <div class="div">
                                    <xsl:value-of select="/info/CUSTOMER_SERVICE/PaymentMethods/text"/>
                                    <!-- xpath -->
                                </div>
                            </div>
                            <!-- Return & Refund -->
                            <div class="return-refund-wrapper">
                                <div class="return-refund">
                                    <xsl:value-of select="/info/CUSTOMER_SERVICE/ReturnRefund/text"/>
                                    <!-- xpath -->
                                </div>
                            </div>
                            <!-- Contact Us -->
                            <div class="div-wrapper">
                                <a href="{/info/CUSTOMER_SERVICE/ContactUs/link}">
                                    <div class="text-wrapper-2">
                                        <xsl:value-of select="/info/CUSTOMER_SERVICE/ContactUs/text"/>
                                        <!-- xpath -->
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- ABOUT WestMed -->
                    <div class="div-2">
                        <div class="text-wrapper-3">ABOUT WestMed</div>
                        <div class="frame-2">
                            <!-- About Us -->
                            <div class="list-item-link-2">
                                <a href="{/info/ABOUT_WestMed/About_Us/link}">
                                    <div class="text-wrapper-4">
                                        <xsl:value-of select="/info/ABOUT_WestMed/About_Us/text"/>
                                        <!-- xpath -->
                                    </div>
                                </a>
                            </div>
                            <!-- Privacy Policy -->
                            <div class="list-item-link-3">
                                <div class="text-wrapper-5">
                                    <xsl:value-of select="/info/ABOUT_WestMed/Privacy_Policy/text"/>
                                    <!-- xpath -->
                                </div>
                            </div>
                            <!-- Flash Deals -->
                            <div class="list-item-link-4">
                                <div class="text-wrapper-6">
                                    <xsl:value-of select="/info/ABOUT_WestMed/Flash_Deals/text"/>
                                    <!-- xpath -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- PAYMENT -->
                    <div class="div-2">
                        <div class="text-wrapper-7">PAYMENT</div>
                        <div class="frame-3">
                            <div class="list-item">
                                <div class="link">.</div>
                            </div>
                            <div class="list-item">
                                <div class="link-2">.</div>
                            </div>
                            <div class="list-item">
                                <div class="link-3">.</div>
                            </div>
                            <div class="list-item">
                                <div class="link-4">.</div>
                            </div>
                            <div class="list-item">
                                <div class="link-5">.</div>
                            </div>
                        </div>
                    </div>
                    <!-- LOGISTICS -->
                    <div class="LOGISTICS">
                        <div class="text-wrapper-8">LOGISTICS</div>
                        <div class="frame-4">
                            <div class="list-item">
                                <div class="link-ph">.</div>
                            </div>
                            <div class="list-item">
                                <div class="link-6">.</div>
                            </div>
                            <div class="list-item">
                                <div class="link-7">.</div>
                            </div>
                            <div class="list-item">
                                <div class="link-8">.</div>
                            </div>
                            <div class="list-item">
                                <div class="link-9">.</div>
                            </div>
                            <div class="list-item">
                                <div class="link-10">.</div>
                            </div>
                        </div>
                    </div>
                    <!-- FOLLOW US -->
                    <div class="FOLLOW-US">
                        <div class="text-wrapper-9">FOLLOW US</div>
                        <div class="facebook">
                            <div class="eabe">.</div>
                            <div class="span-facebook">
                                <a href="{/info/FOLLOW_US/Facebook/link}">                                    <!-- xpath -->
                                    <div class="text-wrapper-10">Facebook</div>
                                </a>
                            </div>
                        </div>
                        <div class="instagram">
                            <div class="e">.</div>
                            <div class="span-instagram">
                                <a href="{/info/FOLLOW_US/Instagram/link}">                                    <!-- xpath -->
                                    <div class="text-wrapper-11">Instagram</div>
                                </a>
                            </div>
                        </div>
                        <div class="twitter">
                            <div class="c">.</div>
                            <div class="span-twitter">
                                <div class="text-wrapper-12">Twitter</div>
                            </div>
                        </div>
                        <div class="linked-in">
                            <div class="element">.</div>
                            <div class="span-linkedin">
                                <div class="text-wrapper-13">LinkedIn</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="div-dmgodq">
                    <p class="p">COPYRIGHT 2024 © WestMed</p>
                </div>
            </div>
        </footer>
    </xsl:template>
</xsl:stylesheet>
